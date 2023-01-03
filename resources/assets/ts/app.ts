/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

import "bootstrap";

if (window.location.pathname.match(/project\/\d+\/(board|task)/))
    import("./pages/board");

if (window.location.pathname.match(/project\/\d+\/(forum|thread)/))
    import("./pages/forum");

if (window.location.pathname.match(/project\/\d+\/info/))
    import("./pages/info");

// Enhancements
import "./enhancements/autoresize";
import "./enhancements/form";
import "./enhancements/imageinput";
import "./enhancements/passwordinput";
import "./enhancements/singleline";
import "./enhancements/tooltip";
