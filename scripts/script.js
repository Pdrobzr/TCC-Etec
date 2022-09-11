window.addEventListener("scroll",  ()=>{
    var header = document.querySelector("header")
    var logForm = document.querySelector("form.logform")

    header.classList.toggle("sticky", window.scrollY)

    if(window.scrollY){
        logForm.style.top="2cm"
    } else {
        logForm.style.top="3cm"
    }
})


function toggleLog(){
    var logForm = document.querySelector("form.logform")

    if(logForm.style.visibility!="visible"){
        logForm.style.visibility="visible"
        logForm.style.opacity=1
    } else{
        logForm.style.opacity=0
        logForm.style.visibility="hidden"
    }
}