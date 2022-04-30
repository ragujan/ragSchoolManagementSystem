window.addEventListener('load',()=>{
    loadform();
})

loadform = ()=>{
    let url = "../../student/uploadassignment/assignmentuploadform.php";

    fetch(url)
        .then((response) => response.text())
        .then((text) => {
           
      
                document.getElementById("studentuploadassignmentDiv").innerHTML=text;
                
            

        });
}