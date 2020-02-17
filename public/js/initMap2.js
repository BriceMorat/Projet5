
	let mapReceiveData = new LeafletMap('map2', [45.764043, 4.835659], 6, 2, 18, 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', [[-80, -170], [80, 170]]);

	mapReceiveData.displayMarkers();
