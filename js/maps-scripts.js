//scripts.js
function mapadevisitas(dataPoints,chartContainer) {
	if(dataPoints==0){
		$('#'+chartContainer).html('No hay datos para mostrar');
		console.log(chartContainer, dataPoints);
	} else {
		var map = AmCharts.makeChart( chartContainer, {
			"type": "map",
			"theme": "light",
			"dataProvider": dataPoints,
			"areasSettings": {
				"unlistedAreasColor": "#FFCC00",
				"unlistedAreasAlpha": 0.9
			},
			"imagesSettings": {
				"color": "#CC0000",
				"rollOverColor": "#f90",
				"selectedColor": "#000000"
			},
			"linesSettings": {
				"arc": -0.7, // this makes lines curved. Use value from -1 to 1
				"color": "#CC0000",
				"alpha": 0.4,
				"arrowAlpha": 1,
				"arrowSize": 4
			},
			"backgroundZoomsToTop": true,
			"linesAboveImages": true,
			"export": {
				"enabled": false
			}
		});
	}
}
//mapadevisitas();

function mapadeventas(data, chartContainer) {
	if(data==0){
		$('#'+chartContainer).html('No hay datos para mostrar');
		console.log(chartContainer, data);
	} else {
		var chart = AmCharts.makeChart( chartContainer, {
		  "type": "serial",
		  "theme": "light",
		  "dataDateFormat": "YYYY-MM-DD",
		  "graphs": [ {
		    "id": "g1",
		    "bullet": "round",
		    "bulletBorderAlpha": 1,
		    "bulletColor": "#FFFFFF",
		    "bulletSize": 5,
		    "hideBulletsCount": 50,
		    "lineThickness": 2,
		    "title": "red line",
		    "useLineColorForBulletBorder": true,
		    "valueField": "value"
		  } ],
		  "chartScrollbar": {
		    "graph": "g1",
		    "oppositeAxis": false,
		    "offset": 30,
		    "scrollbarHeight": 80,
		    "backgroundAlpha": 0,
		    "selectedBackgroundAlpha": 0.1,
		    "selectedBackgroundColor": "#888888",
		    "graphFillAlpha": 0,
		    "graphLineAlpha": 0.5,
		    "selectedGraphFillAlpha": 0,
		    "selectedGraphLineAlpha": 1,
		    "autoGridCount": true,
		    "color": "#AAAAAA"
		  },
		  "chartCursor": {
		    "cursorAlpha": 1,
		    "cursorColor": "#258cbb"
		  },
		  "categoryField": "date",
		  "categoryAxis": {
		    "parseDates": true,
		    "equalSpacing": true,
		    "gridPosition": "middle",
		    "dashLength": 1,
		    "minorGridEnabled": true
		  },
		  "zoomOutOnDataUpdate": false,
		  "listeners": [ {
		    "event": "init",
		    "method": function( e ) {
		      e.chart.zoomToIndexes( e.chart.dataProvider.length - 40, e.chart.dataProvider.length - 1 );
		    }
		  }, {
		    "event": "changed",
		    "method": function( e ) { e.chart.lastCursorPosition = e.index; }
		  } ],
		  "dataProvider": data
		} );
	}
}
//mapadeventas();
function mapadevisitantes(dataPoints, chartContainer) {
	if(dataPoints==0){
		$('#'+chartContainer).html('No hay datos para mostrar');
		console.log(chartContainer, dataPoints);
	} else {
		var chart = AmCharts.makeChart(chartContainer, {
		    "theme": "none",
		    "type": "serial",
		    "marginRight": 80,
		    "autoMarginOffset": 20,
		    "marginTop":20,
		    "dataProvider": dataPoints,
		    "valueAxes": [{
		        "id": "v1",
		        "axisAlpha": 0.1
		    }],
		    "graphs": [{
		        "useNegativeColorIfDown": false,
		        "balloonText": "[[category]]<br><b>value: [[value]]</b>",
		        "bullet": "round",
		        "bulletBorderAlpha": 1,
		        "bulletBorderColor": "#FFFFFF",
		        "hideBulletsCount": 50,
		        "lineThickness": 2,
		        "lineColor": "#fdd400",
		        "negativeLineColor": "#67b7dc",
		        "valueField": "value"
		    }],
		    "chartScrollbar": {
		        "scrollbarHeight": 5,
		        "backgroundAlpha": 0.1,
		        "backgroundColor": "#868686",
		        "selectedBackgroundColor": "#67b7dc",
		        "selectedBackgroundAlpha": 1
		    },
		    "chartCursor": {
		        "valueLineEnabled": true,
		        "valueLineBalloonEnabled": true
		    },
		    "categoryField": "date",
		    "categoryAxis": {
		        "parseDates": true,
		        "axisAlpha": 0,
		        "minHorizontalGap": 60
		    },
		    "export": {
		        "enabled": true
		    }
		});
	}
}
//mapadevisitantes();
/*
function visitas(dataPoints, chartContainer){
var chart = AmCharts.makeChart( chartContainer, {
		  "type": "serial",
		  "theme": "light",
		  "dataDateFormat": "YYYY-MM-DD",
		  "graphs": [ {
		    "id": "g1",
		    "bullet": "round",
		    "bulletBorderAlpha": 1,
		    "bulletColor": "#FFFFFF",
		    "bulletSize": 5,
		    "hideBulletsCount": 50,
		    "lineThickness": 2,
		    "title": "red line",
		    "useLineColorForBulletBorder": true,
		    "valueField": "value"
		  } ],
		  "chartScrollbar": {
		    "graph": "g1",
		    "oppositeAxis": false,
		    "offset": 30,
		    "scrollbarHeight": 80,
		    "backgroundAlpha": 0,
		    "selectedBackgroundAlpha": 0.1,
		    "selectedBackgroundColor": "#888888",
		    "graphFillAlpha": 0,
		    "graphLineAlpha": 0.5,
		    "selectedGraphFillAlpha": 0,
		    "selectedGraphLineAlpha": 1,
		    "autoGridCount": true,
		    "color": "#AAAAAA"
		  },
		  "chartCursor": {
		    "cursorAlpha": 1,
		    "cursorColor": "#258cbb"
		  },
		  "categoryField": "date",
		  "categoryAxis": {
		    "parseDates": true,
		    "equalSpacing": true,
		    "gridPosition": "middle",
		    "dashLength": 1,
		    "minorGridEnabled": true
		  },
		  "zoomOutOnDataUpdate": false,
		  "listeners": [ {
		    "event": "init",
		    "method": function( e ) {
		      e.chart.zoomToIndexes( e.chart.dataProvider.length - 40, e.chart.dataProvider.length - 1 );
		      //e.chart.chartDiv.addEventListener( "click", function() {
		      
		        // we track cursor's last known position by "changed" event
		        //if ( e.chart.lastCursorPosition !== undefined ) {
		        //  // get date of the last known cursor position
		        //  var date = e.chart.dataProvider[ e.chart.lastCursorPosition ][ e.chart.categoryField ];
		        //  // require user to enter annotation text
		        //  var text = window.prompt("Enter annotation","");
		        //  // create a new guide
		        //  var guide = new AmCharts.Guide();
		        //  guide.date = date;
		        //  guide.lineAlpha = 1;
		        //  guide.lineColor = "#c44";
		        //  guide.label = text;
		        //  guide.position = "top";
		        //  guide.inside = true;
		        //  guide.labelRotation = 90;
		        //  e.chart.categoryAxis.addGuide( guide );
		        //  e.chart.validateData();
		        //} 
		      //} )
		    }
		  }, {
		    "event": "changed",
		    "method": function( e ) { e.chart.lastCursorPosition = e.index; }
		  } ],
		  "dataProvider": dataPoints
		} );
}*/