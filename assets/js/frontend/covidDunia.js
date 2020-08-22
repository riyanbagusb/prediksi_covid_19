$('#nama_negara').change(function(){
	var selected = $(this).val();
	if (selected == 'Dunia') {
		url_covid = 'http://127.0.0.1:5000/dunia'
		$.ajax({
			method: 'GET',
			url: url_covid,
			dataType: 'json',
			success:function(response){
				$('canvas#covidDunia').remove()
				$('canvas#persentaseDunia').remove()
				$("div.covidDunia").append('<canvas id="covidDunia" class="animated fadeIn"></canvas>')
				$("div.persentaseDunia").append('<canvas id="persentaseDunia" class="animated fadeIn"></canvas>')
				buildData(response)
			}
		})
	}else{
		url_covid = 'http://127.0.0.1:5000/negara/'+$(this).val()
		$.ajax({
			method: 'GET',
			url: url_covid,
			dataType: 'json',
			success:function(response){
				$('canvas#covidDunia').remove()
				$('canvas#persentaseDunia').remove()
				$("div.covidDunia").append('<canvas id="covidDunia" class="animated fadeIn"></canvas>')
				$("div.persentaseDunia").append('<canvas id="persentaseDunia" class="animated fadeIn"></canvas>')
				buildData(response)
			}
		})
	}
});

$.ajax({
	method: 'GET',
	url: 'http://127.0.0.1:5000/dunia',
	dataType: 'json',
	success:function(response){
		buildData(response)
		total_terkonfirmasi = angkaSeparator(response[response.length -1].Terkonfirmasi)
		total_meninggal = angkaSeparator(response[response.length -1].Meninggal)
		total_pulih = angkaSeparator(response[response.length -1].Pulih)
		$('#total_terkonfirmasi').html(total_terkonfirmasi)
		$('#total_meninggal').html(total_meninggal)
		$('#total_sembuh').html(total_pulih)
		CounterUp()
	}
})

function buildData(data) {
	var tanggalDunia = []
	var terkonfirmasiDunia = []
	var pulihDunia = []
	var meninggalDunia = []
	var terkonfirmasiHarianDunia = []
	var pulihHarianDunia = []
	var meninggalHarianDunia = []
	var persentaseKematianDunia = []
	var persentasePulihDunia = []
	for (let i = data.length-60; i < data.length; i++) {
		tanggalDunia.push(data[i].Tanggal)
		terkonfirmasiDunia.push(data[i].Terkonfirmasi)
		pulihDunia.push(data[i].Pulih)
		meninggalDunia.push(data[i].Meninggal)
		terkonfirmasiHarianDunia.push(data[i]['Terkonfirmasi Harian'])
		pulihHarianDunia.push(data[i]['Pulih Harian'])
		meninggalHarianDunia.push(data[i]['Meninggal Harian'])
		persentaseKematianDunia.push(data[i]['Persentase Kematian'])
		persentasePulihDunia.push(data[i]['Persentase Pulih'])
	}

	Chart.defaults.global.defaultFontColor = "#fff";

	var covid_dunia = document.getElementById('covidDunia').getContext('2d');
	var covidDunia = new Chart(covid_dunia, {
		type: 'line',
		data: {
			labels: tanggalDunia,
			datasets: [
				{
					label: 'Terkonfirmasi',
					data: terkonfirmasiDunia,
					borderColor: 'rgb(0, 123, 255)',
					backgroundColor: 'rgba(0, 123, 255, 0.2)',
				},
				{
					label: 'Meninggal',
					data: meninggalDunia,
					borderColor: 'rgb(220, 53, 69)',
					backgroundColor: 'rgba(220, 53, 69, 0.2)',
				},
				{
					label: 'Pulih',
					data: pulihDunia,
					borderColor: 'rgb(40, 167, 69)',
					backgroundColor: 'rgba(40, 167, 69, 0.2)',
				}
			]
		},
		options: {
			tooltips: {
				mode: 'label'
			},
		}
	});

	var persentase_dunia = document.getElementById('persentaseDunia').getContext('2d');
	var persentaseDunia = new Chart(persentase_dunia, {
		type: 'line',
		data: {
			labels: tanggalDunia,
			datasets: [
				{
					label: 'Terkonfirmasi',
					yAxisID: 'B',
					data: terkonfirmasiHarianDunia,
					borderColor: 'rgb(0, 123, 255)',
					backgroundColor: 'rgba(0, 123, 255, 0)',
					type:'line',
					borderWidth: 1.5,
					pointRadius: 0.5,
				},
				{
					label: 'Meninggal',
					yAxisID: 'B',
					data: meninggalHarianDunia,
					borderColor: 'rgb(220, 53, 69)',
					backgroundColor: 'rgba(220, 53, 69, 0)',
					type:'line',
					borderWidth: 1.5,
					pointRadius: 0.5,
				},
				{
					label: 'Pulih',
					yAxisID: 'B',
					data: pulihHarianDunia,
					borderColor: 'rgb(40, 167, 69)',
					backgroundColor: 'rgba(40, 167, 69, 0)',
					type:'line',
					borderWidth: 1.5,
					pointRadius: 0.5,
				},
				{
					label: 'Peningkatan Persentase Kematian',
					data: persentaseKematianDunia,
					borderColor: 'rgba(111, 66, 193, 0.2)',
					backgroundColor: 'rgba(111, 66, 193, 0.2)',
					borderWidth: 1,
					pointRadius: 0,
				},
				{
					label: 'Peningkatan Persentase Pulih',
					data: persentasePulihDunia,
					borderColor: 'rgba(253, 126, 20, 0.2)',
					backgroundColor: 'rgba(253, 126, 20, 0.2)',
					borderWidth: 1,
					pointRadius: 0,
				},
			]
		},
		options: {
			gridLines: {
				borderDash: [10,10]
			},
			tooltips: {
				mode: 'label'
			},
			scales: {
				yAxes: [{
				  id: 'A',
				  type: 'linear',
				  position: 'right',
				}, {
				  id: 'B',
				  type: 'linear',
				  position: 'left',
				  ticks: {
					min: 0
				  }
				}]
			  }
		}
	});
}