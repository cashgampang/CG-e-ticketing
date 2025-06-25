function showMap(){
var width = 650,
    height = 550;
	
var svg;

//var marks = d3.json(getOfficeDetails());

var csrf = $("meta[name='_csrf']").attr("content");
var marks = d3.json("webHP?requestType=ApplicationRH&actionVal=getOfficeLocation&screenId=90000734&_csrf="+csrf, {
	method:"POST"
});
/*var marks = d3.json("webHP?requestType=ApplicationRH&actionVal=getOfficeLocation&screenId=90000734", {
	method:"POST",
	headers:{
		   "Content-type": "application/json; charset=UTF-8",
		   "X-CSRFToken" : csrf },
});*/

//var unitDataPromise = d3.json("script/common/map/data/unitDetails.json", ({unit, value}) => ({unit: unit, value : +value}));

var statePromise = d3.json("script/common/map/topojson/india_states.json");
//var districtPromise = d3.json("topojson/india_district.json"); 
districtPromise = Promise.resolve('{}');
//var talukaPromise = d3.json("topojson/india_taluk.json"); 
talukaPromise = Promise.resolve('{}');




Promise.all([marks, statePromise])
    .then(function(india){
        
      //  console.log(india[0])
      
        var data = JSON.parse(india[0])
      //  var data = india[4];
        
        var markerMapData=data.mapList;
        
        unit_data = india[0];
        
        states = topojson.feature(india[1], india[1].objects.india_states)
       
		
		
		svg = d3.select(".d3chart").append("svg")
        .attr("width", width)
        .attr("height", height);
		var projection = d3.geoMercator()
            .translate([width / 2, height / 2]);
		var path = d3.geoPath()
              .projection(projection);
        
         var tooltip = d3.select("body").append("div") 
					.attr("class", "tooltip")       
					.style("opacity", 0);
		 var indiaFeature = {
                type: 'FeatureCollection',
                features: states
            };

            // Compute the feature bounds and centroid
            var bounds = d3.geoBounds(states),
                center = d3.geoCentroid(states);

            // Compute the angular distance between bound corners
            var distance = d3.geoDistance(bounds[0], bounds[1]),
                //scale = height / distance / Math.sqrt(2);
				scale = 800;
				//projection.scale(scale).center(center);
//			var marks = [{long:74.2179, lat: 27.0238},{long: 76.2711, lat: 10.8505},{long: 70.1456, lat:24.0454},{long: 75.7139, lat: 19.7515},{long: 78.2932, lat: 34.2996},{long: 78.6569, lat: 22.9734}];
//			var marks = [{long:77.2129193, lat: 28.6109574}];
			
			
			//console.log("marks",marks);

			
            var p=projection.scale(scale).center(center);
			
			
			projection.scale(scale).center(center);
		


        //Data for States
         svg.append("g")
            .attr("class", "states")
            .selectAll("path")
            .data(states.features)
            .enter().append("path")
                .attr("d", path) 
				
				    
	svg.selectAll(".mark")
    .data(markerMapData)
    .enter()
	.append("image")
    .attr('class','mark')
    .attr('width', 20)
    .attr('height', 20)
   .attr("xlink:href",'./script/common/map/marker.png')
   .attr("transform", function(d) {return "translate(" + p([d.longitude,d.lattitude]) + ")";})
   
   .on("mouseover", function(d) {    
       tooltip.transition()    
       .duration(200)    
       .style("opacity", .9);    
       tooltip.html(d.organizationName+" "+d.organizationAddress)  
       .style("left", (d3.event.pageX) + "px")   
       .style("top", (d3.event.pageY - 28) + "px");  
     })          
     .on("mouseout", function(d) {   
       tooltip.transition()    
       .duration(500)    
       .style("opacity", 0); 
     });
         hideProgressbar();
});

}
function getOfficeDetails(){
	let array = [];
	var json = {};
	ajax.post("webHP?requestType=ApplicationRH&actionVal=getOfficeLocation&screenId=90000734", json,
			function(data){
		
		//console.log(data);
		data = JSON.parse(data);
		$.each(data.mapList, function(key,value) {
			let obj = {};
			obj["long"] = value.longitude;
			obj["lat"] = value.lattitude;
			array.push(obj);
			}); 
	},function(data){
		console.log("Data is not comming!");
	});
	console.log(array);
	return array;
}


    