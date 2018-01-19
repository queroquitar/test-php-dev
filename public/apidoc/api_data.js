define({ "api": [
  {
    "type": "get",
    "url": "api/debts/all",
    "title": "all",
    "name": "all",
    "group": "Debts",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Json",
            "optional": false,
            "field": "debts",
            "description": "<p>All debts.</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/DebtController.php",
    "groupTitle": "Debts"
  },
  {
    "type": "get",
    "url": "api/debt/delete/id",
    "title": "delete",
    "name": "delete",
    "group": "Debts",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "id",
            "optional": false,
            "field": "debt",
            "description": "<p>id.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>Response status.</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/DebtController.php",
    "groupTitle": "Debts"
  },
  {
    "type": "get",
    "url": "api/debt/id",
    "title": "get",
    "name": "get",
    "group": "Debts",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "id",
            "optional": false,
            "field": "debt",
            "description": "<p>id.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Json",
            "optional": false,
            "field": "debt",
            "description": "<p>specific debt.</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/DebtController.php",
    "groupTitle": "Debts"
  },
  {
    "type": "post",
    "url": "api/debt/save",
    "title": "save",
    "name": "save",
    "group": "Debts",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "name",
            "optional": false,
            "field": "debt",
            "description": "<p>name.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>Response status.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Informative message.</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/DebtController.php",
    "groupTitle": "Debts"
  },
  {
    "type": "post",
    "url": "api/debt/update/id",
    "title": "update",
    "name": "update",
    "group": "Debts",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "id",
            "optional": false,
            "field": "debt",
            "description": "<p>id.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>Response status.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Informative message.</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/DebtController.php",
    "groupTitle": "Debts"
  },
  {
    "type": "post",
    "url": "api/login",
    "title": "login",
    "name": "login",
    "group": "Login",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "email",
            "optional": false,
            "field": "user",
            "description": "<p>email.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>Response status.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Informative message.</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/ApiAuthController.php",
    "groupTitle": "Login"
  },
  {
    "type": "post",
    "url": "api/logout",
    "title": "logout",
    "name": "logout",
    "group": "Login",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "token",
            "optional": false,
            "field": "user",
            "description": "<p>token.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>Response status.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Informative message.</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/ApiAuthController.php",
    "groupTitle": "Login"
  },
  {
    "type": "post",
    "url": "api/register",
    "title": "register",
    "name": "register",
    "group": "Login",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "name",
            "optional": false,
            "field": "user",
            "description": "<p>name.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>Response status.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "message",
            "description": "<p>Informative message.</p>"
          }
        ]
      }
    },
    "version": "1.0.0",
    "filename": "app/Http/Controllers/ApiAuthController.php",
    "groupTitle": "Login"
  }
] });
