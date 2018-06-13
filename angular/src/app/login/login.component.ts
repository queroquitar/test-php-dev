import { Component, OnInit } from '@angular/core';
import { HttpServiceService} from '../http-service.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  email:string;
  password:string;
  msg:string = "";

  constructor(private http: HttpServiceService, private router: Router){}

  ngOnInit() {
  }

  login(){
    this.http.post("auth/login",{"email":this.email,"password":this.password})
    .subscribe(
      (data: any) => {
        if(data.error)
          this.msg = data.error;
        if(data.access_token){
          this.http.setToken(data.access_token);
          this.router.navigate(["/"]);
        }
        console.log(data);
      },
      err => {
      });
    console.log('click login',this.email,this.password);
  }
}