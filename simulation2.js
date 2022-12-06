let flashcards = document.getElementsByClassName("flashcard");


for(let i = 0 ; i< flashcards.length; i++) { //iterates through all the flashcards from simulation2.php
  flashcards[i].addEventListener('click', function() {
    // console.log(i);
    let side2id = i + 'side2'; //creates the setid generated in simulation2.php
    let side3id = i + 'side3';
    let side2 = document.getElementById(side2id);
    let side3 = document.getElementById(side3id);
    if(side2.style.display == "none")  //if side 2 isn't shown on click, then show
      side2.style.display = "block";
    else
      if(side3.style.display == "none") //if side 2 is visible and side 3 isn't, then show side 3 on click
      side3.style.display = "block";
  });
}
