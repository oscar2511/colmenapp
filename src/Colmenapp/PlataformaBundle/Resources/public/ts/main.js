"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
// src/AppBundle/Resources/public/ts/main.ts
var platform_browser_dynamic_1 = require("@angular/platform-browser-dynamic");
var app_module_1 = require("./app.module");
var test_module_1 = require("./test.module");
var platform = platform_browser_dynamic_1.platformBrowserDynamic();
platform.bootstrapModule(app_module_1.AppModule);
platform.bootstrapModule(test_module_1.TestModule);
//# sourceMappingURL=main.js.map