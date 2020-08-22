$.ajax({
	method: 'GET',
	url: 'http://localhost/php/prediksi_covid_19/api/counter/indonesia',
	dataType: 'json',
	success:function(response){
		console.log(response.data[0].total_kasus)
		total_terkonfirmasi = angkaSeparator(parseInt(response.data[0].total_kasus))
		total_meninggal = angkaSeparator(parseInt(response.data[0].total_meninggal))
		total_pulih = angkaSeparator(parseInt(response.data[0].total_sembuh))
		$('#total_terkonfirmasi').html(total_terkonfirmasi)
		$('#total_meninggal').html(total_meninggal)
		$('#total_sembuh').html(total_pulih)
		CounterUp()
	}
})

$.ajax({
	method: 'GET',
	url: 'http://localhost/php/prediksi_covid_19/api/prediksi/indonesia',
	dataType: 'json',
	success:function(response){
		buildData(response.data)
	}
})

function buildData(data) {
	$.ajax({
		method: 'GET',
		url: 'http://localhost/php/prediksi_covid_19/api/negara/indonesia',
		dataType: 'json',
		success:function(response){
			
			var tanggal = []
			var kasus = []
			var meninggal = []
			var sembuh = []

			var tanggal_prediksi = []
			var prophet = []
			var svm = []
			var batas_training = []
			
			for (let i = 0; i < response.data.length; i++) {
				tanggal.push(response.data[i].tanggal)
				kasus.push(response.data[i].kasus)
				meninggal.push(response.data[i].meninggal)
				sembuh.push(response.data[i].sembuh)
				if (i == Math.round(response.data.length*80/100))
				batas_training.push(response.data[i].tanggal_prediksi)
			}

			for (let i = 0; i < data.length; i++) {
				tanggal_prediksi.push(data[i].tanggal)
				prophet.push(data[i].kasus_prophet)
				svm.push(data[i].kasus_svm)
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
						}
					]
				},
				options: {
					tooltips: {
						mode: 'label'
					},
				}
			});

			Chart.defaults.global.defaultFontColor = "#fff";
			var covid_dunia = document.getElementById('covidDunia').getContext('2d');
			var covidDunia = new Chart(covid_dunia, {
				type: 'line',
				data: {
					labels: tanggal_prediksi,
					datasets: [
						{
							label: 'SVM',
							data: svm,
							borderColor: 'rgb(0, 123, 255)',
							backgroundColor: 'rgba(0, 123, 255, 0)',
							type:'line',
							borderWidth: 1.5,
							pointRadius: 1,
						},
						{
							label: 'Prophet',
							data: prophet,
							borderColor: 'rgb(220, 53, 69)',
							backgroundColor: 'rgba(220, 53, 69, 0)',
							type:'line',
							borderWidth: 1.5,
							pointRadius: 1,
						},
						{
							label: 'Kasus Positif',
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
		}
	})
}