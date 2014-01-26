$("document").ready(function() {
    loadmap();
});


var loadmap = function () {
    //var toado = $("#ToaDo").val();
    var lat = "10.779565";
    var lng = "106.699375";
    /*if (toado != "") {
        var arr = toado.split(',');
        lat = arr[0];
        lng = arr[1];
    }*/


    if (lat != "" && lng != "") {
        initialize(lat, lng);
    }
}

var initialize = function (lat, lng) {
    mapOptions = {
        zoom: 18,
        center: new google.maps.LatLng(lat, lng),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }

    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

    marker = new google.maps.Marker({
        position: map.getCenter(),
        map: map,
        draggable: true,
        animation: google.maps.Animation.DROP,
        title: 'Drag n Drop to get the Location'
    })

    google.maps.event.addListener(marker, 'mousedown', moveMarker);
    google.maps.event.addListener(marker, 'mouseup', pointMarker);
}

var moveMarker = function () {
    if (marker.getAnimation() != null) {
        marker.setAnimation(null);
    } else {
        marker.setAnimation(google.maps.Animation.BOUNCE);
    }
}

var pointMarker = function () {
    var pos = new google.maps.LatLng();
    pos = marker.getPosition();

    var strToaDo = pos.lat() + "," + pos.lng();
    $("#txtLocation").val(strToaDo);
    //$(".frmEditor[rel=location] .txtLat").val(pos.lat());
    //$(".frmEditor[rel=location] .txtLng").val(pos.lng());
}