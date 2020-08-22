import pandas as pd
import numpy as np
import json
import datetime
from flask import abort, Flask, jsonify, redirect, request, url_for
from sklearn.metrics import mean_squared_error, mean_absolute_error

def generate_data(negara):
	terkonfirmasi_df = pd.read_csv('https://raw.githubusercontent.com/CSSEGISandData/COVID-19/master/csse_covid_19_data/csse_covid_19_time_series/time_series_covid19_confirmed_global.csv')
	meninggal_df = pd.read_csv('https://raw.githubusercontent.com/CSSEGISandData/COVID-19/master/csse_covid_19_data/csse_covid_19_time_series/time_series_covid19_deaths_global.csv')
	pulih_df = pd.read_csv('https://raw.githubusercontent.com/CSSEGISandData/COVID-19/master/csse_covid_19_data/csse_covid_19_time_series/time_series_covid19_recovered_global.csv')

	terkonfirmasi_df.dtypes

	tanggal = terkonfirmasi_df.columns[4:]
	terkonfirmasi_df2 = terkonfirmasi_df.melt(id_vars=['Province/State', 'Country/Region', 'Lat', 'Long'], value_vars=tanggal, var_name='Tanggal', value_name='Terkonfirmasi')
	meninggal_df2 = meninggal_df.melt(id_vars=['Province/State', 'Country/Region', 'Lat', 'Long'], value_vars=tanggal, var_name='Tanggal', value_name='Meninggal')
	pulih_df2 = pulih_df.melt(id_vars=['Province/State', 'Country/Region', 'Lat', 'Long'], value_vars=tanggal, var_name='Tanggal', value_name='Pulih')

	pulih_df2 = pulih_df2[pulih_df2['Country/Region']!='Canada']

	full_table = pd.merge(left=terkonfirmasi_df2, right=meninggal_df2, how='left', on=['Province/State', 'Country/Region', 'Tanggal', 'Lat', 'Long'])
	full_table = pd.merge(left=full_table, right=pulih_df2, how='left', on=['Province/State', 'Country/Region', 'Tanggal', 'Lat', 'Long'])
	full_table.shape
	full_table.isna().sum()
	full_table[full_table['Pulih'].isna()]['Country/Region'].value_counts()
	full_table[full_table['Pulih'].isna()]['Tanggal'].value_counts()
	full_table['Meninggal'] = full_table['Meninggal'].fillna(0)
	full_table['Pulih'] = full_table['Pulih'].fillna(0)
	full_table['Terkonfirmasi'] = full_table['Terkonfirmasi'].astype(int)
	full_table['Meninggal'] = full_table['Meninggal'].astype(int)
	full_table['Pulih'] = full_table['Pulih'].astype(int)
	full_table.isna().sum()
	full_table['Country/Region'] = full_table['Country/Region'].replace('Korea, South', 'South Korea')
	full_table = full_table[full_table['Province/State'].str.contains('Pulih')!=True]
	full_table = full_table[full_table['Province/State'].str.contains(',')!=True]
	feb_12_conf = {'Hubei' : 34874}

	def change_val(date, ref_col, val_col, dtnry):
		for key, val in dtnry.items():
			full_table.loc[(full_table['Tanggal']==date) & (full_table[ref_col]==key), val_col] = val
	change_val('2/12/20', 'Province/State', 'Terkonfirmasi', feb_12_conf)

	full_table = full_table.groupby(['Country/Region', 'Tanggal'], sort=False).agg({'Terkonfirmasi':'sum','Meninggal':'sum','Pulih':'sum'}).reset_index().reset_index().sort_values(['Country/Region', 'index']).drop(['index'], axis=1).reset_index(drop=True)

	pk_df = pd.DataFrame({'Persentase Kematian':round((full_table['Meninggal'].div(full_table['Terkonfirmasi'])*100), 2)})
	pp_df = pd.DataFrame({'Persentase Pulih':round((full_table['Pulih'].div(full_table['Terkonfirmasi'])*100), 2)})
	pk_df.loc[~np.isfinite(pk_df['Persentase Kematian']), 'Persentase Kematian'] = 0
	pp_df.loc[~np.isfinite(pp_df['Persentase Pulih']), 'Persentase Pulih'] = 0

	kh_head = full_table.groupby(['Country/Region'])[['Terkonfirmasi', 'Meninggal', 'Pulih']].head(1)
	kh_df = full_table.groupby(['Country/Region'])[['Terkonfirmasi', 'Meninggal', 'Pulih']].diff()
	kh_df = kh_df.fillna(value=kh_head).rename(columns={"Terkonfirmasi": "Terkonfirmasi Harian", "Meninggal": "Meninggal Harian", "Pulih": "Pulih Harian"})

	full_table = full_table.join(kh_df).join(pk_df.join(pp_df))

	full_table['Tanggal'] = full_table['Tanggal'].astype('datetime64').dt.strftime('%Y-%m-%d')
	data = full_table.loc[full_table['Country/Region'].str.lower() == negara.lower()]

	return data

def get_data(id):
	url = 'http://localhost/php/prediksi_covid_19/api/negara/'+str(id)
	df = pd.read_json(url, orient='records')
	full_table = df.data.apply(pd.Series)
	full_table['kasus'] = full_table['kasus'].astype('int')
	full_table['meninggal'] = full_table['meninggal'].astype('int')
	full_table['sembuh'] = full_table['sembuh'].astype('int')
	full_table['aktif'] = full_table['kasus'] - full_table['meninggal'] - full_table['sembuh']

	pk_df = pd.DataFrame({'persentase_kematian':round((full_table['meninggal'].div(full_table['kasus'])*100), 2)})
	pp_df = pd.DataFrame({'persentase_kesembuhan':round((full_table['sembuh'].div(full_table['kasus'])*100), 2)})
	pk_df.loc[~np.isfinite(pk_df['persentase_kematian']), 'persentase_kematian'] = 0
	pp_df.loc[~np.isfinite(pp_df['persentase_kesembuhan']), 'persentase_kesembuhan'] = 0

	full_table = full_table.join(pk_df.join(pp_df))

	temp = full_table.groupby(['negara_id', 'tanggal'])['kasus', 'meninggal', 'sembuh']
	temp = temp.sum().diff().reset_index()
	mask = temp['negara_id'] != temp['negara_id'].shift(1)
	temp.loc[mask, 'kasus'] = np.nan
	temp.loc[mask, 'meninggal'] = np.nan
	temp.loc[mask, 'sembuh'] = np.nan
	temp.columns = ['negara_id', 'tanggal', 'kasus_harian', 'meninggal_harian', 'sembuh_harian']
	full_table = pd.merge(full_table, temp, on=['negara_id', 'tanggal'])
	kolom = ['kasus_harian', 'meninggal_harian', 'sembuh_harian']
	full_table[kolom] = full_table[kolom].fillna(0).astype('int')
	full_table['kasus_harian'] = full_table['kasus_harian'].apply(lambda x: 0 if x<0 else x)
	return full_table

def using_svm(full_table, kolom):
	data = full_table[['tanggal', kolom]]
	data_tanggal = data.tanggal
	list_data = np.array(data[kolom]).reshape(-1, 1)
	hari_prediksi = 30
	list_tanggal = np.array([i for i in range(len(data_tanggal))]).reshape(-1, 1)
	prediksi = np.array([i for i in range(len(data_tanggal)+hari_prediksi)]).reshape(-1, 1)

	from sklearn.model_selection import train_test_split
	X_train, X_test, y_train, y_test = train_test_split(list_tanggal, list_data, test_size=0.3, shuffle=False)

	from sklearn.svm import SVR
	#svm_data = SVR(shrinking=True, kernel='rbf', epsilon=0.0001, degree=2, C=1)
	#svm_data = SVR(shrinking=True, kernel='poly',gamma='auto', epsilon=1, degree=2, C=0.1, cache_size=3000)
	#svm_data = SVR(shrinking=True, kernel='poly',gamma='auto', epsilon=1, degree=2, C=0.1, coef0=1, cache_size=3000, max_iter=-1)
	svm_data = SVR(shrinking=True, kernel='rbf', gamma=0.0001, C=1000000, cache_size=3000, max_iter=-1)
	#svm_data.fit(X_train, y_train.ravel())
	svm_data.fit(list_tanggal, list_data.ravel())
	svm_prediksi = svm_data.predict(prediksi)
	svm = pd.DataFrame({'svm_'+kolom:svm_prediksi})


	tanggal_kasus = full_table['tanggal'].astype('datetime64')
	tanggal_terakhir = tanggal_kasus.max()
	tanggal_prediksi = []
	for i in range(hari_prediksi):
		tanggal_terakhir += datetime.timedelta(days=1)
		tanggal_prediksi.append(tanggal_terakhir)

	tanggal_prediksi = pd.DataFrame({'tanggal': tanggal_prediksi})
	tanggal_kasus = pd.DataFrame({'tanggal': tanggal_kasus})
	tanggal = pd.concat([tanggal_kasus, tanggal_prediksi]).reset_index(drop=True)
	tanggal['tanggal'] = tanggal['tanggal'].astype(str).str[:10]

	hasil = pd.concat([tanggal, svm], axis=1, join='inner').reset_index(drop=True)
	hasil['svm_'+kolom] = hasil['svm_'+kolom].round()

	#svm_test_pred = svm_data.predict(X_test)

	error_df = pd.concat([pd.DataFrame(list_data), pd.DataFrame(svm_prediksi).tail(30)])

	#error_data = [mean_squared_error(svm_test_pred, y_test), mean_absolute_error(svm_test_pred, y_test), mean_absolute_percentage_error(svm_test_pred, y_test)]
	error_data = [mean_squared_error(svm_prediksi, error_df), mean_absolute_error(svm_prediksi, error_df), mean_absolute_percentage_error(svm_prediksi, error_df)]

	return hasil, error_data

def using_prophet(full_table, kolom):
	from fbprophet import Prophet

	df_prophet = full_table.rename({'tanggal': "ds", kolom: "y"}, axis=1)

	m = Prophet(
		changepoint_prior_scale=0.99,
		changepoint_range=0.99,
		daily_seasonality=False,
		weekly_seasonality=False,
		yearly_seasonality=False
    )

	m.fit(df_prophet)

	future = m.make_future_dataframe(periods=30)
	forecast = m.predict(future)
	forecast['ds'] = forecast['ds'].astype(str).str[:10]

	forecast = pd.DataFrame({'tanggal':forecast['ds'],'prophet_'+kolom:round(forecast['yhat'])})

	error_df = forecast.set_index('tanggal')[['prophet_'+kolom]].join(df_prophet.set_index('ds').y).reset_index()
	error_df.dropna(inplace=True)

	error_data = [mean_squared_error(error_df['prophet_'+kolom], error_df.y), mean_absolute_error(error_df['prophet_'+kolom], error_df.y), mean_absolute_percentage_error(error_df['prophet_'+kolom], error_df.y)]

	return forecast, error_data

def percentage_error(actual, predicted):
	res = np.empty(actual.shape)
	for j in range(actual.shape[0]):
		if actual[j] != 0:
			res[j] = (actual[j] - predicted[j]) / actual[j]
		else:
			res[j] = predicted[j] / np.mean(actual)
	return res

def mean_absolute_percentage_error(y_true, y_pred):
	return np.mean(np.abs(percentage_error(np.asarray(y_true), np.asarray(y_pred)))) * 100

def response_api(data):
	return (
		jsonify(**data),
		data['status']
	)

app = Flask(__name__)

@app.errorhandler(404)
def not_found(e):
	return response_api({
		'status': 404,
		'message': 'Data tidak ditemukan.',
		'data': None
	})

@app.errorhandler(500)
def not_found(e):
	return response_api({
		'status': 500,
		'message': 'Sepertinya ada masalah pada server.',
		'data': None
	})

@app.route('/')
def root():
	data = {
			'status': 200,
			'message': 'Selamat Datang di Sistem Prediksi Perkembangan COVID-19',
			'data': None
		}
	return response_api(data)

@app.route('/api/')
def api():
	data = {
			'status': 200,
			'message': 'Selamat Datang di Sistem Prediksi Perkembangan COVID-19',
			'data': None
		}
	return response_api(data)

@app.route('/api/generate/<negara>', methods=['GET'])
def generate(negara):
	row = json.loads(generate_data(negara).to_json(orient='records'))
	data = {
			'status': 200,
			'message': 'Selamat Datang di Sistem Prediksi Perkembangan COVID-19',
			'data': row
		}
	return response_api(data)

@app.route('/api/last/<negara>', methods=['GET'])
def last(negara):
	row = json.loads(generate_data(negara).tail(1).to_json(orient='records'))
	data = {
			'status': 200,
			'message': 'Selamat Datang di Sistem Prediksi Perkembangan COVID-19',
			'data': row
		}
	return response_api(data)

@app.route('/api/negara/', methods=['GET'])
def country():
	id = None
	row = json.loads(get_data(id).to_json(orient='records'))
	data = {
			'status': 200,
			'message': 'Selamat Datang di Sistem Prediksi Perkembangan COVID-19',
			'data': row
		}
	return response_api(data)

@app.route('/api/negara/<int:id>/')
def negara(id=None):
	row = json.loads(get_data(id).to_json(orient='records'))
	data = {
		'status': 200,
		'message': 'Sistem Prediksi Perkembangan COVID-19',
		'data': row
	}
	return response_api(data)

@app.route('/api/negara/<int:id>/prophet/')
def negara_prophet(id=None):
	kasus = using_prophet(get_data(id), 'kasus')
	meninggal = using_prophet(get_data(id), 'meninggal')
	sembuh = using_prophet(get_data(id), 'sembuh')
	aktif = using_prophet(get_data(id), 'aktif')

	prophet = pd.concat([kasus[0], meninggal[0]['prophet_meninggal'], sembuh[0]['prophet_sembuh'], aktif[0]['prophet_aktif']], axis=1)

	list_error = [kasus[1], meninggal[1], sembuh[1], aktif[1]]
	label = ['kasus','meninggal','sembuh','aktif']
	error_data = pd.DataFrame(list_error, columns=['MSE', 'MAE', 'MAPE'], index=label).reset_index()

	#data = { "prediksi" : prophet.to_json(orient='records'), "error_data" : error_data.to_json(orient='records') }
	#merged_data = json.dumps(data)
	row = json.loads(prophet.to_json(orient='records'))
	row_error = json.loads(error_data.to_json(orient='records'))

	data = {
		'status': 200,
		'message': 'Sistem Prediksi Perkembangan COVID-19',
		'data': row,
		'error_data': row_error

	}
	return response_api(data)

@app.route('/api/negara/<int:id>/svm/')
def negara_svm(id=None):
	kasus = using_svm(get_data(id), 'kasus')
	meninggal = using_svm(get_data(id), 'meninggal')
	sembuh = using_svm(get_data(id), 'sembuh')
	aktif = using_svm(get_data(id), 'aktif')

	svm = pd.concat([kasus[0], meninggal[0]['svm_meninggal'], sembuh[0]['svm_sembuh'], aktif[0]['svm_aktif']], axis=1)

	list_error = [kasus[1], meninggal[1], sembuh[1], aktif[1]]
	label = ['kasus','meninggal','sembuh','aktif']
	error_data = pd.DataFrame(list_error, columns=['MSE', 'MAE', 'MAPE'], index=label).reset_index()

	row = json.loads(svm.to_json(orient='records'))
	row_error = json.loads(error_data.to_json(orient='records'))

	data = {
		'status': 200,
		'message': 'Sistem Prediksi Perkembangan COVID-19',
		'data': row,
		'error_data': row_error
	}
	return response_api(data)

@app.route('/api/negara/<int:id>/prediksi/')
def negara_prediksi(id=None):
	p_kasus = using_prophet(get_data(id), 'kasus')
	p_meninggal = using_prophet(get_data(id), 'meninggal')
	p_sembuh = using_prophet(get_data(id), 'sembuh')
	p_aktif = using_prophet(get_data(id), 'aktif')

	prophet = pd.concat([p_kasus[0], p_meninggal[0]['prophet_meninggal'], p_sembuh[0]['prophet_sembuh'], p_aktif[0]['prophet_aktif']], axis=1)

	s_kasus = using_svm(get_data(id), 'kasus')
	s_meninggal = using_svm(get_data(id), 'meninggal')
	s_sembuh = using_svm(get_data(id), 'sembuh')
	s_aktif = using_svm(get_data(id), 'aktif')

	svm = pd.concat([s_kasus[0], s_meninggal[0]['svm_meninggal'], s_sembuh[0]['svm_sembuh'], s_aktif[0]['svm_aktif']], axis=1)

	hasil = pd.concat([prophet, svm['svm_aktif'], svm['svm_kasus'], svm['svm_meninggal'], svm['svm_sembuh']], axis=1, join='inner').reset_index(drop=True)

	list_error = [p_kasus[1], p_meninggal[1], p_sembuh[1], p_aktif[1], s_kasus[1], s_meninggal[1], s_sembuh[1], s_aktif[1]]
	label = ['prophet_kasus','prophet_meninggal','prophet_sembuh','prophet_aktif','svm_kasus','svm_meninggal','svm_sembuh','svm_aktif']
	error_data = pd.DataFrame(list_error, columns=['MSE', 'MAE', 'MAPE'], index=label).reset_index()

	row = json.loads(hasil.to_json(orient='records'))
	row_error = json.loads(error_data.to_json(orient='records'))

	data = {
		'status': 200,
		'message': 'Sistem Prediksi Perkembangan COVID-19',
		'data': row,
		'error_data': row_error
	}
	return response_api(data)

if __name__ == '__main__':
	app.run()