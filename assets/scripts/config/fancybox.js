import { Fancybox } from "@fancyapps/ui";
import "../../../node_modules/@fancyapps/ui/dist/fancybox/fancybox.css";
import { pt } from "@fancyapps/ui/dist/fancybox/l10n/pt.esm.js";

Fancybox.bind('[data-fancybox="gallery"]', {
  l10n: pt,
});
