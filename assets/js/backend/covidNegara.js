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
			$("div.covidNegara").append('<canvas class="mt-4" id="covidNegara" class="animated fadeIn"></canvas>')
			$("div.covidKasus").append('<canvas id="covidKasus" class="animated fadeIn"></canvas>')
			$("div.covidMeninggal").append('<canvas id="covidMeninggal" class="animated fadeIn"></canvas>')
			$("div.covidSembuh").append('<canvas id="covidSembuh" class="animated fadeIn"></canvas>')
			$("div.covidAktif").append('<canvas id="covidAktif" class="animated fadeIn"></canvas>')
			buildData(response.data, selected)
			selisihCheck(selected)
		}
	})
});

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
				selisihCheck('indonesia')
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

function selisihCheck(negara) {
	$("#f_kasus").empty().append('Memproses...')
	$("#f_meninggal").empty().append('Memproses...')
	$("#f_sembuh").empty().append('Memproses...')
	$("#f_aktif").empty().append('Memproses...')
	$("#f_tanggal").empty().append('Memproses...')
	$.ajax({
		method: 'GET',
		url: 'http://localhost:5000/api/last/'+negara,
		dataType: 'json',
		error:function(){
			$("#f_kasus").empty().append('Tidak Terhubung...')
			$("#f_meninggal").empty().append('Tidak Terhubung...')
			$("#f_sembuh").empty().append('Tidak Terhubung...')
			$("#f_aktif").empty().append('Tidak Terhubung...')
			$("#f_tanggal").empty().append('Tidak Terhubung...')
		},
		success:function(response){
			let kasus = Number(response.data[0].Terkonfirmasi)
			let meninggal = Number(response.data[0].Meninggal)
			let sembuh = Number(response.data[0].Pulih)
			let aktif = kasus - meninggal - sembuh
			let tanggal = response.data[0].Tanggal
			let tanggal_id = tanggalId(tanggal)

			$("#f_kasus").empty().append(angkaSeparator(parseInt(kasus)))
			$("#f_meninggal").empty().append(angkaSeparator(parseInt(meninggal)))
			$("#f_sembuh").empty().append(angkaSeparator(parseInt(sembuh)))
			$("#f_aktif").empty().append(angkaSeparator(parseInt(aktif)))
			$("#f_tanggal").empty().append(tanggal_id)

			$.ajax({
				method: 'GET',
				url: `http://localhost/php/prediksi_covid_19/api/selisih_prediksi/${negara}/${tanggal}`,
				dataType: 'json',
				success:function(response){
					let p_kasus = Number(response.data[0].kasus_prophet)
					let p_meninggal = Number(response.data[0].meninggal_prophet)
					let p_sembuh = Number(response.data[0].sembuh_prophet)
					let p_aktif = Number(response.data[0].aktif_prophet)
					let s_kasus = Number(response.data[0].kasus_svm)
					let s_meninggal = Number(response.data[0].meninggal_svm)
					let s_sembuh = Number(response.data[0].sembuh_svm)
					let s_aktif = Number(response.data[0].aktif_svm)

					function persentase(a,b){
						hasil = ((b - a) / a * 100).toFixed(2)
						return hasil
					}

					function faktual(a,b){
						hasil = b - a
						return hasil
					}

					let pa_kasus = faktual(kasus,p_kasus)
					let pp_kasus = persentase(kasus,p_kasus)
					let sa_kasus = faktual(kasus,s_kasus)
					let sp_kasus = persentase(kasus,s_kasus)

					let pa_meninggal = faktual(meninggal,p_meninggal)
					let pp_meninggal = persentase(meninggal,p_meninggal)
					let sa_meninggal = faktual(meninggal,s_meninggal)
					let sp_meninggal = persentase(meninggal,s_meninggal)

					let pa_sembuh = faktual(sembuh,p_sembuh)
					let pp_sembuh = persentase(sembuh,p_sembuh)
					let sa_sembuh = faktual(sembuh,s_sembuh)
					let sp_sembuh = persentase(sembuh,s_sembuh)

					let pa_aktif = faktual(aktif,p_aktif)
					let pp_aktif = persentase(aktif,p_aktif)
					let sa_aktif = faktual(aktif,s_aktif)
					let sp_aktif = persentase(aktif,s_aktif)

					$("#p_kasus").empty().append(angkaSeparator(parseInt(p_kasus)))
					$("#s_kasus").empty().append(angkaSeparator(parseInt((s_kasus))))
					$("#pa_kasus").empty().append(angkaSeparator(parseInt(pa_kasus)))
					$("#pp_kasus").empty().append(pp_kasus+'%')
					$("#sa_kasus").empty().append(angkaSeparator(parseInt(sa_kasus)))
					$("#sp_kasus").empty().append(sp_kasus+'%')

					$("#p_meninggal").empty().append(angkaSeparator(parseInt(p_meninggal)))
					$("#s_meninggal").empty().append(angkaSeparator(parseInt(s_meninggal)))
					$("#pa_meninggal").empty().append(angkaSeparator(parseInt(pa_meninggal)))
					$("#pp_meninggal").empty().append(pp_meninggal+'%')
					$("#sa_meninggal").empty().append(angkaSeparator(parseInt(sa_meninggal)))
					$("#sp_meninggal").empty().append(sp_meninggal+'%')

					$("#p_sembuh").empty().append(angkaSeparator(parseInt(p_sembuh)))
					$("#s_sembuh").empty().append(angkaSeparator(parseInt(s_sembuh)))
					$("#pa_sembuh").empty().append(angkaSeparator(parseInt(pa_sembuh)))
					$("#pp_sembuh").empty().append(pp_sembuh+'%')
					$("#sa_sembuh").empty().append(angkaSeparator(parseInt(sa_sembuh)))
					$("#sp_sembuh").empty().append(sp_sembuh+'%')

					$("#p_aktif").empty().append(angkaSeparator(parseInt(p_aktif)))
					$("#s_aktif").empty().append(angkaSeparator(parseInt((s_aktif))))
					$("#pa_aktif").empty().append(angkaSeparator(parseInt(pa_aktif)))
					$("#pp_aktif").empty().append(pp_aktif+'%')
					$("#sa_aktif").empty().append(angkaSeparator(parseInt(sa_aktif)))
					$("#sp_aktif").empty().append(sp_aktif+'%')
				}
			})
		}
	})
}