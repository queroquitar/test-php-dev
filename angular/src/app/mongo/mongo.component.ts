import { Component, OnInit, OnChanges } from '@angular/core';
import { HttpServiceService} from '../http-service.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-mongo',
  templateUrl: './mongo.component.html',
  styleUrls: ['./mongo.component.css']
})
export class MongoComponent implements OnInit {

  items:any[] = [];

  constructor(private http: HttpServiceService, private route: Router){}

  ngOnInit() {
    this.loaditems();
  }

  ngAfterViewInit(){
    this.loaditems();
  }

  loaditems(){
    if(this.items.length == 0){
      this.http.get("mongo").subscribe(
        (data:any) => {
          this.items = data.data;
        },
        err => {
          if(err.error && err.error.error == "token_not_provided"){
            this.route.navigate(["/login"]);          
          }
        }
      );
    }
  }

}
