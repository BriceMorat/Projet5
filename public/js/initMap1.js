window.onload = () => {

	let mapSendData = new LeafletMap('map1', [45.764043, 4.835659], 6, 2, 18, 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', [[-80, -170], [80, 170]]);

	mapSendData.latLngLocationSaved();
}

