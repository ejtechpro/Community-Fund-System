function toggleNavigation(){
  let sideBar = document.querySelector('#sidebarMenu');

  sideBar.classList.toggle('active')
}


function showPayoutSection(){
  let payoutSection = document.querySelector('.payout-section');
    payoutSection.classList.toggle('active');
 }

function displayIMG(file){
  document.getElementById("profile-img").src = URL.createObjectURL(file);
}



//   const payBtn = document.querySelectorAll(".payBtn");

//   for(n=0; n < payBtn.length; n++){
//   payBtn[n].addEventListener('click', function(e){
//     e.preventDefault();
//     console.log(payBtn[1])
//   });
// }

function payMember(userId,groupId,fullName,payAmount){
  let payForm = document.getElementById("payForm");
  payForm.userId.value = userId;  
  payForm.groupId.value = groupId;  
  payForm.fullName.value = fullName;  
  payForm.payAmount.value = payAmount;  
  // alert(payForm.userId.value)
}