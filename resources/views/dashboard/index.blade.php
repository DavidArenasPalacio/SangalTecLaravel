@extends('layouts.app')

@section('content')
    
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<figure class="highcharts-figure">
  <div id="container"></div>
  <p class="highcharts-description">
    Este grafico muestra la cantidad de ventas que se han realizado en cada mes del año actual
  </p>
</figure>
<br>
<br>
<figure class="highcharts-figure">
  <div id="container1"></div>
  <p class="highcharts-description">
    Este grafico muestra la cantidad de compras que se han realizado en cada mes del año actual
  </p>
</figure>

<script type="text/javascript">

var ventas = <?php echo json_encode($ventasData)?>;

Highcharts.chart('container', {
  chart: {
    type: 'column'
  },
  title: {
      text:'Grafico Ventas'
  },
  subtitle:{
      text: 'Cantidad de ventas realizadas por mes.'
  },
  xAxis:{
    
      categories:['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
      
    },
  yAxis:{
      title:{
          text:'Producto'
      }
  },
  legend:{
      layout: 'vertical',
      aling:'right',
      verticalAlign:'middle'
  },
  plotOptions:{
      series: {
          allowPointSelect:true
      }
  },
  series:[{
    name: 'Ventas',
    data: ventas
  }],
  responsive:{}
  });

  
  var compras = <?php echo json_encode($comprasData)?>;

Highcharts.chart('container1', {

   
  chart: {
    type: 'column'
  },
  title: {
      text:'Grafico Compras'
  },
  subtitle:{
      text: 'Cantidad de compras realizadas por mes.'
  },
  xAxis:{
      categories:['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
  },
  yAxis:{
      title:{
          text:'Producto'
      }
  },
  legend:{
      layout: 'vertical',
      aling:'right',
      verticalAlign:'middle'
  },
  plotOptions:{
      series: {
          allowPointSelect:true
      }
  },
  series:[{
    name: 'Compras',
    data: compras
  }],
  responsive:{}
  });
  
</script>

@endsection