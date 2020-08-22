$.ajax({
	method: 'GET',
	url: 'http://localhost/php/prediksi_covid_19/api/prediksi/1',
	dataType: 'json',
	success:function(response){
		buildData(response.data)
	}
})

// $.ajax({
// 	method: 'GET',
// 	url: 'http://127.0.0.1:5000/api/negara/1/svm/',
// 	dataType: 'json',
// 	success:function(response){
// 		console.log(response.data.length)
// 		// buildData(response)
// 	}
// })

function buildData(data) {
	$.ajax({
		method: 'GET',
		url: 'http://localhost/php/prediksi_covid_19/api/negara/1',
		dataType: 'json',
		success:function(response){
			
			var kasus = []
			var tanggal = []
			var prophet = []
			var svm = []
			var batas_training = []
			
			for (let i = 0; i < response.data.length; i++) {
				kasus.push(response.data[i].kasus)
				if (i == Math.round(response.data.length*80/100))
				batas_training.push(response.data[i].tanggal)
			}

			for (let i = 0; i < data.length; i++) {
				tanggal.push(data[i].tanggal)
				prophet.push(data[i].kasus_prophet)
				svm.push(data[i].kasus_svm)
			}

			var covid_dunia = document.getElementById('covidDunia').getContext('2d');
			var covidDunia = new Chart(covid_dunia, {
				type: 'line',
				data: {
					labels: tanggal,
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