
    <!-- Main content -->
    <section class="content">
    <div class="box">
            <div class="box-header">
              <h3 class="box-title">Comandes (Redsys Pending)</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                      <tr>
                        <th>Order No</th>
                        <th>Preu total</th>
                        <th>Curs</th>
                        <th>Llibre</th>
                        <th>Nom de l'estudiant</th>
                         <th>Nom del pare de l'estudiant  </th>
                         <th>DNI</th>
                         <th>Correu electrònic</th>
                         <th>Telèfon no</th>
                         <!--<th>Estat</th>-->
                         <th>mètode de pagament</th>
                         <th>Data</th>
                         <th>Acciò</th>
                      </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
    </section>
    
<script>
    function getTextValue(s, space) {
        let span= document.createElement('span');
        span.innerHTML= s;
        if(space) {
            const children= span.querySelectorAll('*');
            for(var i = 0 ; i < children.length ; i++) {
                if(children[i].textContent)
                    children[i].textContent+= ' ';
                else
                    children[i].innerText+= ' ';
            }
        }
      return [span.textContent || span.innerText].toString().replace(/ +/g,' ');
    }
    $(document).ready(function(){
        $(this).on("click", ".btn-approve", function(e){
            e.preventDefault();
            let jsonData = {
                maunal_approve: 1,
                order_id: parseInt($(this).data("order").replace("#ORD_", "")),
                order_email: getTextValue($(this).data("email")),
                stdname: getTextValue($(this).data("stdname")),
                fathername: getTextValue($(this).data("fthname")),
                dni: getTextValue($(this).data("dni")),
                books: {}
            };
            
            $.ajax({
                method: "POST",
                url: "/admin/cheffunctions.php",
                data: {
                    action: 'order_books_details',
                    order_id: jsonData.order_id
                }
            }).done(function(details){
                details = JSON.parse(details);
                jsonData.books = details.books;
                console.log(jsonData);
                $.ajax({
                    method: "POST",
                    url: "/response_handler.php",
                    data: jsonData
                }).done(function(r){
                    $("body > div > aside > section > ul > li:nth-child(12) > a").click();
                });
            });
        });
    });
</script>