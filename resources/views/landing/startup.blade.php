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

      var createChart = function (title, data, elementId) {
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
              display: true,
              text: 'Chart.js Line Chart'
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

        var ctx = document.getElementById(elementId).getContext('2d');
        new Chart(ctx, config);

      };
      window.onload = function () {
        createChart('Monthly revenue', @json($monthly), 'canvas1');
        createChart('Total paid users', @json($paid), 'canvas2');
        createChart('Total free users', @json($free), 'canvas3');
      }
    </script>
@endpush