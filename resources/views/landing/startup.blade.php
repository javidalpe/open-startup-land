@extends('layouts.dashboard')

@section('container')
    <div>
        <canvas id="canvas1"></canvas>
    </div>
    <div>
        <canvas id="canvas2"></canvas>
    </div>
    <div>
        <canvas id="canvas3"></canvas>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"></script>
    <script>

      var createChart = function (title, data, elementId, label) {
        var config = {
          type: 'line',
          data: {
            labels: @json($dates),
            datasets: [{
              label: title,
              backgroundColor: "red",
              borderColor: "red",
              data: data,
              fill: false,
            }]
          },
          options: {
            responsive: true,
            title: {
              display: false
            },
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
                  display: false,
                  labelString: 'Day'
                }
              }],
              yAxes: [{
                display: true,
                scaleLabel: {
                  display: true,
                  labelString: label
                },
                ticks: {
                  // Include a dollar sign in the ticks
                  callback: function(value, index, values) {
                    if (label === "USD")
                      return '$' + value.toFixed(1);
                    if (label === "EUR")
                      return value.toFixed(1) + '€'
                    return value.toFixed(0);
                  }
                }
              }]
            }
          }
        };

        var ctx = document.getElementById(elementId).getContext('2d');
        new Chart(ctx, config);

      };
      window.onload = function () {
        createChart('Monthly revenue', @json($monthly), 'canvas1', @json($currency));
        createChart('Total paid users', @json($paid), 'canvas2', 'Users');
        createChart('Total free users', @json($free), 'canvas3', 'Users');
      }
    </script>
@endpush