<!-- Modal -->
<div class="modal fade" id="m_patient_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-fluid" role="document">
		<div class="modal-content">

			<div class="modal-body" style="background-color: #fafafa;">
				<div class="row">

					<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
						<div class="d-flex">
							<div>
								<h4 class="text-dark font-weight-bold">Patient Record</h4>
							</div>
							<div class="ml-auto">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true" class="text-danger">&times;</span>
								</button>
							</div>
						</div>
					</div>

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

						<div class="my-3 p-3 bg-white rounded shadow-sm">
							<div class="row">

								<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
									<div class="media text-muted pt-3">
										<img src="assets/img/avatars/boy.svg" alt="" class="mr-2 rounded" style="height: 60px; width: 60px;">
										<div class="media-body pb-3 mb-0 small lh-125" style="font-size: 12px;">
											<div class="d-flex justify-content-between align-items-center w-100">
												<strong class="text-dark">Mr. Mark Dherrick P. Cuevas</strong>
											</div>
											<span class="d-block">Patient ID: ALPX-3829</span>
											<span class="d-block">Age: 18</span>
										</div>
									</div>
								</div>

							</div>
						</div>

						<div class="my-3 p-3 bg-white rounded shadow-sm">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
									<h6 class="pb-2 mb-0">Patient Overview</h6>
								</div>
							</div>

							<div class="row">
								<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
									<h6 class="bg-info text-light p-2 small mt-2">Vitals & Information</h6>

									<div class="row p-2">

										<div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
											<label class="font-weight-bold">Last Vitals</label><hr style="margin-top: -3px;">

											<div class="d-flex border-bottom mt-1 mb-1">
												<div>
													<h6 class="small">Height</h6>
												</div>

												<div class="ml-auto">
													<h6 class="small font-weight-bold">5'6</h6>
												</div>
											</div>

											<div class="d-flex border-bottom mt-1 mb-1">
												<div>
													<h6 class="small">Weight</h6>
												</div>

												<div class="ml-auto">
													<h6 class="small font-weight-bold">75 kgs</h6>
												</div>
											</div>

											<div class="d-flex border-bottom mt-1 mb-1">
												<div>
													<h6 class="small">BMI</h6>
												</div>

												<div class="ml-auto">
													<h6 class="small font-weight-bold">28</h6>
												</div>
											</div>

											<div class="d-flex border-bottom mt-1 mb-1">
												<div>
													<h6 class="small">Temperature</h6>
												</div>

												<div class="ml-auto">
													<h6 class="small font-weight-bold">38°</h6>
												</div>
											</div>

											<div class="d-flex border-bottom mt-1 mb-1">
												<div>
													<h6 class="small">Respiratory Rate</h6>
												</div>

												<div class="ml-auto">
													<h6 class="small font-weight-bold">28/min</h6>
												</div>
											</div>

											<div class="d-flex border-bottom mt-1 mb-1">
												<div>
													<h6 class="small">Pulse</h6>
												</div>

												<div class="ml-auto">
													<h6 class="small font-weight-bold">89/min</h6>
												</div>
											</div>

											<div class="d-flex border-bottom mt-1 mb-1">
												<div>
													<h6 class="small">Blood Pressure</h6>
												</div>

												<div class="ml-auto">
													<h6 class="small font-weight-bold">125/80</h6>
												</div>
											</div>
										</div>

										<div class="col-lg-8 col-md-8 col-xs-8 col-sm-8">
											<label class="font-weight-bold">BMI</label><hr style="margin-top: -3px;">
											<div style="width:100%;">
												<canvas id="bmi_chart"></canvas>
											</div>
										</div>

									</div>

								</div>

								<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
									<h6 class="bg-info text-light p-2 small mt-2">Visits</h6>
								</div>

								<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
									<h6 class="bg-info text-light p-2 small mt-2">Current Medications</h6>
								</div>
							</div>
						</div>

					</div>

				</div>

			</div>
		</div>

	</div>
</div>

<script type="text/javascript">
	window.chartColors = {
		red: 'rgb(255, 99, 132)',
		orange: 'rgb(255, 159, 64)',
		yellow: 'rgb(255, 205, 86)',
		green: 'rgb(75, 192, 192)',
		blue: 'rgb(54, 162, 235)',
		purple: 'rgb(153, 102, 255)',
		grey: 'rgb(201, 203, 207)'
	};

	(function(global) {
		var Months = [
		'January',
		'February',
		'March',
		'April',
		'May',
		'June',
		'July',
		'August',
		'September',
		'October',
		'November',
		'December'
		];

		var COLORS = [
		'#4dc9f6',
		'#f67019',
		'#f53794',
		'#537bc4',
		'#acc236',
		'#166a8f',
		'#00a950',
		'#58595b',
		'#8549ba'
		];

		var Samples = global.Samples || (global.Samples = {});
		var Color = global.Color;

		Samples.utils = {
		// Adapted from http://indiegamr.com/generate-repeatable-random-numbers-in-js/
		srand: function(seed) {
			this._seed = seed;
		},

		rand: function(min, max) {
			var seed = this._seed;
			min = min === undefined ? 0 : min;
			max = max === undefined ? 1 : max;
			this._seed = (seed * 9301 + 49297) % 233280;
			return min + (this._seed / 233280) * (max - min);
		},

		numbers: function(config) {
			var cfg = config || {};
			var min = cfg.min || 0;
			var max = cfg.max || 1;
			var from = cfg.from || [];
			var count = cfg.count || 8;
			var decimals = cfg.decimals || 8;
			var continuity = cfg.continuity || 1;
			var dfactor = Math.pow(10, decimals) || 0;
			var data = [];
			var i, value;

			for (i = 0; i < count; ++i) {
				value = (from[i] || 0) + this.rand(min, max);
				if (this.rand() <= continuity) {
					data.push(Math.round(dfactor * value) / dfactor);
				} else {
					data.push(null);
				}
			}

			return data;
		},

		labels: function(config) {
			var cfg = config || {};
			var min = cfg.min || 0;
			var max = cfg.max || 100;
			var count = cfg.count || 8;
			var step = (max - min) / count;
			var decimals = cfg.decimals || 8;
			var dfactor = Math.pow(10, decimals) || 0;
			var prefix = cfg.prefix || '';
			var values = [];
			var i;

			for (i = min; i < max; i += step) {
				values.push(prefix + Math.round(dfactor * i) / dfactor);
			}

			return values;
		},

		months: function(config) {
			var cfg = config || {};
			var count = cfg.count || 12;
			var section = cfg.section;
			var values = [];
			var i, value;

			for (i = 0; i < count; ++i) {
				value = Months[Math.ceil(i) % 12];
				values.push(value.substring(0, section));
			}

			return values;
		},

		color: function(index) {
			return COLORS[index % COLORS.length];
		},

		transparentize: function(color, opacity) {
			var alpha = opacity === undefined ? 0.5 : 1 - opacity;
			return Color(color).alpha(alpha).rgbString();
		}
	};

	// DEPRECATED
	window.randomScalingFactor = function() {
		return Math.round(Samples.utils.rand(-100, 100));
	};

	// INITIALIZATION

	Samples.utils.srand(Date.now());

	// Google Analytics
	/* eslint-disable */
	if (document.location.hostname.match(/^(www\.)?chartjs\.org$/)) {
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-28909194-3', 'auto');
		ga('send', 'pageview');
	}
	/* eslint-enable */

}(this));

	var config = {
		type: 'line',
		data: {
			labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
			datasets: [
			{
				backgroundColor: window.chartColors.green,
				borderColor: window.chartColors.green,
				data: [
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor(),
				randomScalingFactor()
				],
				fill: true,
			}]
		},
		options: {
			responsive: true,
			tooltips: {
				mode: 'index',
				intersect: false,
			},
			hover: {
				mode: 'nearest',
				intersect: true
			},
			scales: {
				xAxes: [{
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Month'
					}
				}],
				yAxes: [{
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Value'
					}
				}]
			}
		}
	};

	window.onload = function() {
		var ctx = document.getElementById('bmi_chart').getContext('2d');
		window.myLine = new Chart(ctx, config);
	};
</script>