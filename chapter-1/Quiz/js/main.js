//BMI = 體重(公斤) / (身高(公尺) x 身高(公尺))
// 計算功能寫在外面，是另外的功能應另外寫出來


// 宣告 DOM
let bmiText =document.querySelector('#bmiText');
bmiText.style.display="none";
//事件點擊按鈕
let btn =document.querySelector('.calcualteBMI');
let reset =document.querySelector('.reset');
//事件點擊鍵盤
const inputk =document.querySelectorAll('input');

//計算 BMI

function bmi(weight,height){
    let w = parseInt(weight);
    let h = parseInt(height)/100;//因為公分要轉公尺所以除以100
    let bmi = (w/(h*h)).toFixed(2);//toFixed讓小數點4捨5入只有2位
    return bmi;

}

// 取出輸入值寫入畫面
function calculateBMI(e){
    console.log(e);
    let bodyWeight =document.querySelector('.bodyWeight').value;
    let bodyHeight =document.querySelector('.bodyHeight').value;
    let resultText =document.querySelector('#resultText');
    let bmiText =document.querySelector('#bmiText');
    //  印出值來
    if((bodyWeight !="" ) && (bodyHeight != "")){

        bmiText.style.display="block";
        resultText.innerHTML = bmi(bodyWeight,bodyHeight);
        bmiText.innerHTML =  checkBMI(bmi(bodyWeight,bodyHeight));

    }else{
        bmiText.style.display="none";
        alert("請輸入身高體重！");
        return;
    };

}



//  bmi 範圍
function checkBMI(bmi){

    if( bmi < 18.5){
        return "太輕了"
    }else if( bmi >=18.5 &&  bmi < 24){
        return "體重正常 "
    }else if( bmi >=24 &&  bmi < 27){
        return "過重 "
    }else if( bmi >=27 &&  bmi < 30){
        return "輕度肥胖 "
    }else if( bmi >=30 &&  bmi < 35){
        return "中度肥胖 "
    }else if( bmi  >=35){
        return "重度肥胖 "
    }


}
//清空值
function undo(e){
    document.querySelector('.bodyWeight').value ='';
    document.querySelector('.bodyHeight').value ='';
    bmiText.style.display="none";
    resultText.innerHTML = 0;
    return
}

//事件監聽
btn.addEventListener('click', calculateBMI);
// console.log(inputk)
// inputk.forEach(v=>{

//   v.addEventListener('keydown', calculateBMI)

// });
reset.addEventListener('click',undo);










