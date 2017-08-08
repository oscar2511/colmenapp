// src/AppBundle/Resources/public/ts/main.ts
import { platformBrowserDynamic } from '@angular/platform-browser-dynamic';
import { AppModule } from './app.module';
import { TestModule } from './test.module';

const platform = platformBrowserDynamic();
platform.bootstrapModule(AppModule);
