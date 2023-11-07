$(".card-for-not").on("click" ,function(){
    const str = $(this).attr('data-value');
    const arr = str.split(',');
    if(arr[1] == "true") {
        // alert(base_url);
        // console.log(arr);
        $.ajax({
            type: "GET",
            url: base_url + '/post?postid='+arr[2],
            success: function(data){
                // alert(base_url);
                window.location.href = base_url+"/"+arr[0];
            }
        });
        return false;
    }
    // alert(base_url);

    window.location.href = base_url+"/"+arr[0];
});

upload.onchange = evt => {
  const [file] = upload.files
  if (file) {
    imageframe.src = URL.createObjectURL(file)
  }
}