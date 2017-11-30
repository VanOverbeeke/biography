/*Add a Input field which updates a property ('username') via Two-Way-Binding
Output the username property via String Interpolation (in a paragraph below the input)
Add a button which may only be clicked if the username is NOT an empty string
Upon clicking the button, the username should be reset to an empty string*/
import { Component } from '@angular/core';

@Component({
    selector: 'app-assignment2',
    templateUrl: './assignment2.component.html',
})
export class Assignment2Component {
    title = 'assignment2';
    username = '';

    checkStringEmpty (str) {
        return (!str);
    }

    reset () {
        this.username = '';
    }
}
