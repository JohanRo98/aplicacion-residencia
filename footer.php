<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
  integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
  integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>


<script>
$(document).ready( function (){
$("#tabla_id").DataTable({
  "pageLength":40,
  lengthMenu:[
    [50,80,100,150],
    [50,80,100,150]
  ],
  "language":{
    "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
  }

});
});
</script>

<script>
function borrar(id){
    Swal.fire({
        title: "¿Deseas borrar el registro?",
        showCancelButton: true,
        confirmButtonText: "Si, Borrar",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location="index.php?txtID="+id;
  } 
})
}
</script>


</body>

</html>