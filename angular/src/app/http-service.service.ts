import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class HttpServiceService {

  private url = "http://localhost:8000/api/";
  private token = '';

  constructor(private http: HttpClient) { }

  get(resource: string){
    return this.http.get(this.url+resource+this.getToken());
  }

  post(resource: string,params){
    return this.http.post(this.url+resource+this.getToken(),this.formatData(params), {
      headers: new HttpHeaders().set('Content-Type', 'application/x-www-form-urlencoded')
    })
  }

  setToken(token:string){
    this.token = token;
  }

  private getToken(){
    if(this.token)
      return "?token="+this.token;
    return "";
  }

  private formatData(data) {
    let returnData = '';
    let count = 0;
    for (let i in data) {
      if (count == 0) {
        returnData += i + '=' + data[i];
      } else {
        returnData += '&' + i + '=' + data[i];
      }
      count = count + 1;
    }
    return returnData;
  }
}
