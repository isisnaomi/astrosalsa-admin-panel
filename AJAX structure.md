# WEB SERVICES #

##Estructura general##

    $.ajax({
      method: "POST",
      url: "../control/conmmunicationhandler.php",
      dataType: "json",
      data: {
        target: " "
        type: " "
        data: {" ", " ", ... , " "} | " "
        }
      });

## Valores permitidos en la request ##

* target: studentsAdministrator | packagesAdministrator | subscriptionsAdministrator

    * type: "add"
          * data: { "columna1", "columna2", ... "columnaN" }

    * type: "update"
          * data:{
                rowFilters: { "nombreColumna1", "nombreColumna2", ... , "nombreColumnaN" } }
                attributes: { "dataColumna1", "dataColumna2", ... , "dataColumnaN" } ,
                 }

    * type: "getList"
          * data: { "attribute1", "attribute2", ... , "attributeN" }

    * type: "delete"
          * data: "idObject"


* target: "studentsAdministrator"

    * type: "getStudentByID"
          * data: "idStudent"


* target: "packagesAdministrator"

    * type: "getPackageByID"
          * data: "packageId"


* target: "packagesAdministrator"

    * type: "getSubscriptionByPackageID"
          * data: "packageId"

    * type: "getSubscriptionByStudentID"
          * data: "studentId"
