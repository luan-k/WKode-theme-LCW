import "../styles/main.scss";

/* import "./modules/counter.js"; */

import { DisplayLabel } from "./components/counter";

let Main = {
  init: async function () {
    // initialize demo javascript component - async/await invokes some
    //  level of babel transformation
    const displayLabel = new DisplayLabel();
    await displayLabel.init();
  },
};

Main.init();

console.log(document.getElementById("main")[0]);
