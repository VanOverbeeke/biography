import { Component } from '@angular/core';

@Component({
    selector: 'app-body',
    templateUrl: './body.component.html',
})
export class BodyComponent {
    title = 'body';
    d = {
        'key1': 'value # 1',
        'key2': 'value # 2'
    };
    lastOne = null;
    key = 'key3';
    value = 'value3';
    delKey = 'key3';

    checkBothButtons () {
        return (!this.key || !this.value);
    }

    checkKey (key, obj) {
        return ( key in obj );
    }

    checkLength (obj) {
        return (obj.length > 3);
    }

    pushData (key, value, obj) {
        obj[key] = value;
        this.lastOne = key;
        this.key = key + '1';
    }

    randData (obj) {
        const tkey = 'key_' + Math.random().toString(26).substring(2,7);
        const tvalue = Math.random().toString(36).substring(2,7);
        obj[tkey] = tvalue;
        this.lastOne = tkey;
    }

    delData (key, obj) {
        delete obj[key];
        this.delKey = Object.keys(obj)[0];
    }

    printData (obj) {
        return Object.keys(obj);
    }

    getColor() {
        return this.checkLength(this.d) === true ? 'green' : 'red';
    }
}
