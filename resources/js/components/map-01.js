import jsVectorMap from "jsvectormap";
import "jsvectormap/dist/maps/world";

const map01 = () => {
  const mapSelectorOne = document.querySelector("#mapOne");

  if (!mapSelectorOne) return;

  const markers = (users || [])
    .filter(item => item.latitude && item.longitude)
    .map(item => ({
      name: item.package?.city?.name ?? "Tidak diketahui",
      coords: [
        parseFloat(item.latitude),
        parseFloat(item.longitude)
      ],
     
    }));

  new jsVectorMap({
    selector: "#mapOne",
    map: "world",

    focusOn: {
      region: "ID",
      animate: true,
    },

    zoom: 5,

    markerStyle: {
      initial: {
        strokeWidth: 1,
        fill: "#465fff",
        fillOpacity: 1,
        r: 4,
      },
      hover: {
        fill: "#465fff",
        fillOpacity: 1,
      },
    },

    markers: markers,
  });
};

export default map01;