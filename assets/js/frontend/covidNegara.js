$('#nama_negara').change(function(){
	var selected = $(this).val();
	url_covid = 'http://localhost/php/prediksi_covid_19/api/prediksi/'+selected
	$.ajax({
		method: 'GET',
		url: url_covid,
		dataType: 'json',
		success:function(response){
			$('canvas#covidNegara').remove()
			$('canvas#covidKasus').remove()
			$('canvas#covidMeninggal').remove()
			$('canvas#covidSembuh').remove()
			$('canvas#covidAktif').remove()
			$("div.covidNegara").append('<canvas id="covidNegara" class="animated fadeIn"></canvas>')
			$("div.covidKasus").append('<canvas id="covidKasus" class="animated fadeIn"></canvas>')
			$("div.covidMeninggal").append('<canvas id="covidMeninggal" class="animated fadeIn"></canvas>')
			$("div.covidSembuh").append('<canvas id="covidSembuh" class="animated fadeIn"></canvas>')
			$("div.covidAktif").append('<canvas id="covidAktif" class="animated fadeIn"></canvas>')
			buildData(response.data, selected)
			metodeCheck(selected)
		}
	})
});

$.ajax({
	method: 'GET',
	url: 'http://localhost/php/prediksi_covid_19/api/counter/indonesia',
	dataType: 'json',
	success:function(response){
		total_terkonfirmasi = angkaSeparator(parseInt(response.data[0].total_kasus))
		total_meninggal = angkaSeparator(parseInt(response.data[0].total_meninggal))
		total_pulih = angkaSeparator(parseInt(response.data[0].total_sembuh))
		total_aktif = angkaSeparator(parseInt(response.data[0].total_kasus - response.data[0].total_meninggal - response.data[0].total_sembuh))
		$('#total_terkonfirmasi').html(total_terkonfirmasi)
		$('#total_meninggal').html(total_meninggal)
		$('#total_sembuh').html(total_pulih)
		$('#total_aktif').html(total_aktif)
		CounterUp()
		metodeCheck('indonesia')
	}
})

$.ajax({
	method: 'GET',
	url: 'http://localhost/php/prediksi_covid_19/api/negara',
	dataType: 'json',
	success:function(negara){
		$.ajax({
			method: 'GET',
			url: 'http://localhost/php/prediksi_covid_19/api/prediksi/'+negara.data[0]['negara'],
			dataType: 'json',
			success:function(response){
				buildData(response.data, negara.data[0]['negara'])
			}
		})
	}
})

function buildData(data, negara) {
	$.ajax({
		method: 'GET',
		url: 'http://localhost/php/prediksi_covid_19/api/negara/'+negara,
		dataType: 'json',
		success:function(response){
			
			var tanggal = []
			var kasus = []
			var meninggal = []
			var sembuh = []
			var aktif = []

			var tanggal_prediksi = []
			var prophet_kasus = []
			var prophet_meninggal = []
			var prophet_sembuh = []
			var prophet_aktif = []
			var svm_kasus = []
			var svm_meninggal = []
			var svm_sembuh = []
			var svm_aktif = []
			var batas_training = []
			
			for (let i = 0; i < response.data.length; i++) {
				tanggal.push(response.data[i].tanggal)
				kasus.push(response.data[i].kasus)
				meninggal.push(response.data[i].meninggal)
				sembuh.push(response.data[i].sembuh)
				aktif.push(response.data[i].kasus - response.data[i].meninggal - response.data[i].sembuh)
				if (i == Math.round(response.data.length*80/100))
				batas_training.push(response.data[i].tanggal_prediksi)
			}

			for (let i = 0; i < data.length; i++) {
				tanggal_prediksi.push(data[i].tanggal)
				prophet_kasus.push(data[i].kasus_prophet)
				prophet_meninggal.push(data[i].meninggal_prophet)
				prophet_sembuh.push(data[i].sembuh_prophet)
				prophet_aktif.push(data[i].aktif_prophet)
				svm_kasus.push(data[i].kasus_svm)
				svm_meninggal.push(data[i].meninggal_svm)
				svm_sembuh.push(data[i].sembuh_svm)
				svm_aktif.push(data[i].aktif_svm)
			}
			var covid_negara = document.getElementById('covidNegara').getContext('2d');
			var covidNegara = new Chart(covid_negara, {
				type: 'line',
				data: {
					labels: tanggal,
					datasets: [
						{
							label: 'Kasus',
							data: kasus,
							borderColor: 'rgb(0, 123, 255)',
							backgroundColor: 'rgba(0, 123, 255, 0.2)',
							borderWidth: 1.5,
							pointRadius: 1,
						},
						{
							label: 'Meninggal',
							data: meninggal,
							borderColor: 'rgb(220, 53, 69)',
							backgroundColor: 'rgba(220, 53, 69, 0.2)',
							borderWidth: 1.5,
							pointRadius: 1,
						},
						{
							label: 'Sembuh',
							data: sembuh,
							borderColor: 'rgb(40, 167, 69)',
							backgroundColor: 'rgba(40, 167, 69, 0.2)',
							borderWidth: 1.5,
							pointRadius: 1,
						},
						{
							label: 'Aktif',
							data: aktif,
							borderColor: 'rgb(247, 107, 0)',
							backgroundColor: 'rgba(247, 107, 0, 0.2)',
							borderWidth: 1.5,
							pointRadius: 1,
						}
					]
				},
				options: {
					tooltips: {
						mode: 'label'
					},
					legend: {
						labels: {
							fontColor: 'white'
						}
					},
					scales: {
						yAxes: [{
							ticks: {
								fontColor: 'white'
							},
						}],
					  xAxes: [{
							ticks: {
								fontColor: 'white'
							},
						}]
					} 
				}
			});

			// Chart.defaults.global.defaultFontColor = "#fff";
			var covid_kasus = document.getElementById('covidKasus').getContext('2d');
			var covidKasus = new Chart(covid_kasus, {
				type: 'line',
				data: {
					labels: tanggal_prediksi,
					datasets: [
						{
							label: 'SVM',
							data: svm_kasus,
							borderColor: 'rgb(0, 123, 255)',
							backgroundColor: 'rgba(0, 123, 255, 0)',
							type:'line',
							borderWidth: 1.5,
							pointRadius: 1,
						},
						{
							label: 'Prophet',
							data: prophet_kasus,
							borderColor: 'rgb(220, 53, 69)',
							backgroundColor: 'rgba(220, 53, 69, 0)',
							type:'line',
							borderWidth: 1.5,
							pointRadius: 1,
						},
						{
							label: 'Kasus',
							data: kasus,
							borderColor: 'rgb(40, 167, 69)',
							backgroundColor: 'rgba(40, 167, 69, 0.5)',
							type:'line',
							borderWidth: 1.5,
							pointRadius: 0.5,
						}
					]
				},
				options: {
					tooltips: {
						mode: 'label',
						callbacks: {
							label: function(tooltipItem, data) {
								var label = data.datasets[tooltipItem.datasetIndex].label
								var value = tooltipItem.yLabel
								if(parseInt(value) >= 1000){
									return label + ': ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
								} else {
									return label + ': ' + value
								}
							}
						}
					},
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero: true,
								callback: function(value, index, values) {
									if(parseInt(value) >= 1000){
										return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
									} else {
										return value;
									}
								}
							}
						}]
					}
				}
			});
			var covid_meninggal = document.getElementById('covidMeninggal').getContext('2d');
			var covidMeninggal = new Chart(covid_meninggal, {
				type: 'line',
				data: {
					labels: tanggal_prediksi,
					datasets: [
						{
							label: 'SVM',
							data: svm_meninggal,
							borderColor: 'rgb(0, 123, 255)',
							backgroundColor: 'rgba(0, 123, 255, 0)',
							type:'line',
							borderWidth: 1.5,
							pointRadius: 1,
						},
						{
							label: 'Prophet',
							data: prophet_meninggal,
							borderColor: 'rgb(220, 53, 69)',
							backgroundColor: 'rgba(220, 53, 69, 0)',
							type:'line',
							borderWidth: 1.5,
							pointRadius: 1,
						},
						{
							label: 'Meninggal',
							data: meninggal,
							borderColor: 'rgb(40, 167, 69)',
							backgroundColor: 'rgba(40, 167, 69, 0.5)',
							type:'line',
							borderWidth: 1.5,
							pointRadius: 0.5,
						}
					]
				},
				options: {
					tooltips: {
						mode: 'label',
						callbacks: {
							label: function(tooltipItem, data) {
								var label = data.datasets[tooltipItem.datasetIndex].label
								var value = tooltipItem.yLabel
								if(parseInt(value) >= 1000){
									return label + ': ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
								} else {
									return label + ': ' + value
								}
							}
						}
					},
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero: true,
								callback: function(value, index, values) {
									if(parseInt(value) >= 1000){
										return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
									} else {
										return value;
									}
								}
							}
						}]
					}
				}
			});
			var covid_sembuh = document.getElementById('covidSembuh').getContext('2d');
			var covidSembuh = new Chart(covid_sembuh, {
				type: 'line',
				data: {
					labels: tanggal_prediksi,
					datasets: [
						{
							label: 'SVM',
							data: svm_sembuh,
							borderColor: 'rgb(0, 123, 255)',
							backgroundColor: 'rgba(0, 123, 255, 0)',
							type:'line',
							borderWidth: 1.5,
							pointRadius: 1,
						},
						{
							label: 'Prophet',
							data: prophet_sembuh,
							borderColor: 'rgb(220, 53, 69)',
							backgroundColor: 'rgba(220, 53, 69, 0)',
							type:'line',
							borderWidth: 1.5,
							pointRadius: 1,
						},
						{
							label: 'Sembuh',
							data: sembuh,
							borderColor: 'rgb(40, 167, 69)',
							backgroundColor: 'rgba(40, 167, 69, 0.5)',
							type:'line',
							borderWidth: 1.5,
							pointRadius: 0.5,
						}
					]
				},
				options: {
					tooltips: {
						mode: 'label',
						callbacks: {
							label: function(tooltipItem, data) {
								var label = data.datasets[tooltipItem.datasetIndex].label
								var value = tooltipItem.yLabel
								if(parseInt(value) >= 1000){
									return label + ': ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
								} else {
									return label + ': ' + value
								}
							}
						}
					},
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero: true,
								callback: function(value, index, values) {
									if(parseInt(value) >= 1000){
										return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
									} else {
										return value;
									}
								}
							}
						}]
					}
				}
			});
			var covid_aktif = document.getElementById('covidAktif').getContext('2d');
			var covidAktif = new Chart(covid_aktif, {
				type: 'line',
				data: {
					labels: tanggal_prediksi,
					datasets: [
						{
							label: 'SVM',
							data: svm_aktif,
							borderColor: 'rgb(0, 123, 255)',
							backgroundColor: 'rgba(0, 123, 255, 0)',
							type:'line',
							borderWidth: 1.5,
							pointRadius: 1,
						},
						{
							label: 'Prophet',
							data: prophet_aktif,
							borderColor: 'rgb(220, 53, 69)',
							backgroundColor: 'rgba(220, 53, 69, 0)',
							type:'line',
							borderWidth: 1.5,
							pointRadius: 1,
						},
						{
							label: 'Aktif',
							data: aktif,
							borderColor: 'rgb(40, 167, 69)',
							backgroundColor: 'rgba(40, 167, 69, 0.5)',
							type:'line',
							borderWidth: 1.5,
							pointRadius: 0.5,
						}
					]
				},
				options: {
					tooltips: {
						mode: 'label',
						callbacks: {
							label: function(tooltipItem, data) {
								var label = data.datasets[tooltipItem.datasetIndex].label
								var value = tooltipItem.yLabel
								if(parseInt(value) >= 1000){
									return label + ': ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
								} else {
									return label + ': ' + value
								}
							}
						}
					},
					scales: {
						yAxes: [{
							ticks: {
								beginAtZero: true,
								callback: function(value, index, values) {
									if(parseInt(value) >= 1000){
										return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
									} else {
										return value;
									}
								}
							}
						}]
					}
				}
			});
		}
	})
}

function metodeCheck(negara) {
	$.ajax({
		method: 'GET',
		url: 'http://localhost/php/prediksi_covid_19/api/rekomendasi/'+negara,
		dataType: 'json',
		success:function(response){
			prophet = response.data.error[0].MAE
			svm = response.data.error[1].MAE
			if(Number(prophet) < Number(svm)){
				prediksi_awal = response.data.data_prediksi.awal[0].kasus_prophet
				prediksi_akhir = response.data.data_prediksi.akhir[0].kasus_prophet
				rekomendasiCheck(response.data, prediksi_awal, prediksi_akhir)
			}else{
				prediksi_awal = response.data.data_prediksi.awal[1].kasus_prophet
				prediksi_akhir = response.data.data_prediksi.akhir[1].kasus_prophet
				rekomendasiCheck(response.data, prediksi_awal, prediksi_akhir)
			}
		}
	})
}

function rekomendasiCheck(data, prediksi_awal, prediksi_akhir) {
	total_kasus = data.data_faktual[0].total_kasus
	persentase_kenaikan = Math.round((Number(prediksi_akhir)-Number(prediksi_awal))/Number(prediksi_awal)*100)
	if (Number(total_kasus) > Number(prediksi_awal)) {
		$("#persentase_kenaikan").empty()
		$("#persentase_kenaikan").append(persentase_kenaikan)
		$(".data-rekomendasi").remove()
		$("#rekomendasi").append('<li class="data-rekomendasi list-group-item">Prediksi tidak akurat, tidak dapat memberikan rekomendasi</li>')
	}else{
		$.ajax({
			method: 'GET',
			url: 'http://localhost/php/prediksi_covid_19/api/data_rekomendasi/'+persentase_kenaikan,
			dataType: 'json',
			success:function(response){
				$("#persentase_kenaikan").empty()
				$("#persentase_kenaikan").append(persentase_kenaikan)
				$(".data-rekomendasi").remove()
				for (let i = 0; i < response.data.length; i++) {
					$("#rekomendasi").append('<li class="data-rekomendasi list-group-item">'+response.data[i].rekomendasi+'</li>')
				}
			}
		})
	}
}