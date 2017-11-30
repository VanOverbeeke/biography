import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { FormsModule} from '@angular/forms';
import { AppComponent } from './app.component';
import { HeaderComponent } from './biography/header/header.component';
import { FooterComponent } from './biography/footer/footer.component';
import { BodyComponent } from './biography/body/body.component';
import {Assignment2Component} from "./biography/assignment2/assignment2.component";

@NgModule({
  declarations: [
    AppComponent,
      HeaderComponent,
      BodyComponent,
      FooterComponent,
      Assignment2Component

  ],
  imports: [
    BrowserModule,
      FormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
