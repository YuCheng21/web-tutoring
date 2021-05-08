const button_submit = document.getElementById("submit")

button_submit.addEventListener("click",function () {
    const height = document.getElementById("height-value").value
    const weight = document.getElementById("weight-value").value
    let bmi = weight / (height/100)**2

    const result_text = document.getElementById("result-text")
    if(bmi < 18.5){
        result_text.innerText = "體重過輕"
        result_text.style.backgroundColor = "yellow"
    }else if(bmi >= 18.5 && bmi < 24){
        result_text.innerText = "健康體位"
        result_text.style.backgroundColor = "green"
    }else if(bmi >= 24 && bmi < 27){
        result_text.innerText = "體重過重"
        result_text.style.backgroundColor = "yellow"
    }else if(bmi >= 27 && bmi < 30){
        result_text.innerText = "輕度肥胖"
        result_text.style.backgroundColor = "red"
    }else if(bmi >= 30 && bmi < 35){
        result_text.innerText = "中度肥胖"
        result_text.style.backgroundColor = "red"
    }else if(bmi >= 35){
        result_text.innerText = "重度肥胖"
        result_text.style.backgroundColor = "purple"
    }

    document.getElementById("result-value").innerText = bmi.toFixed(2)

})

const button_reset = document.getElementById("reset")

button_reset.addEventListener("click",function () {
    document.getElementById("height-value").value = ""
    document.getElementById("weight-value").value = ""
    document.getElementById("result-text").innerText = ""
    document.getElementById("result-value").innerText = ""

})