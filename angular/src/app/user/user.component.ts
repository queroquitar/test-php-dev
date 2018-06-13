import { Component, OnInit } from '@angular/core';
import { HttpServiceService} from '../http-service.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-user',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.css']
})
export class UserComponent implements OnInit {

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
      this.http.get("user").subscribe(
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
