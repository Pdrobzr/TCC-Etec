var bannerReg = document.getElementById("bannerReg")
var bannerRegP = document.getElementById("bannerRegP")
var subBannerReg = document.getElementById("subBannerReg")

bannerReg.addEventListener("mouseover", ()=>{
    bannerRegP.style.visibility="hidden"
    subBannerReg.style.visibility="visible"

    bannerRegP.style.opacity="0"
    subBannerReg.style.opacity="1"
})

bannerReg.addEventListener("mouseout", ()=>{
    bannerRegP.style.visibility="visible"
    subBannerReg.style.visibility="hidden"

    bannerRegP.style.opacity="1"
    subBannerReg.style.opacity="0"
})