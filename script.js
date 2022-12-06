

//this is unimplemented JS script that I grabbed from a tutorial and originally used for my create. It is unused in the final website.






var contentArray = localStorage.getItem('items') ? JSON.parse(localStorage.getItem('items')) : [];

document.getElementById("save-btn").addEventListener("click", () => {
  addFlashcard();
});

document.getElementById("delete-btn").addEventListener("click", () => {
  localStorage.clear();
  flashcards.innerHTML = '';
  contentArray = [];
});

document.getElementById("add-btn").addEventListener("click", () => {
  document.getElementById("create-box").style.display = "block";
});

document.getElementById("close-btn").addEventListener("click", () => {
  document.getElementById("create-box").style.display = "none";
});

flashcardMaker = (text, delThisIndex) => {
  const flashcard = document.createElement("div");
  const side1 = document.createElement('h2');
  const side2 = document.createElement('h2');
  const side3 = document.createElement('h2');
  const del = document.createElement('i');

  flashcard.className = 'flashcard';

  side1.setAttribute("style", "text-align: center; padding: 15px; margin-top:30px");
  side1.textContent = text.my_side1;

  side2.setAttribute("style", "padding: 15px; text-align:center; display:none; color:red");
  // side2.setAttribute("style", "padding: 15px; text-align:center; color:red; display:none;");
  side2.textContent = text.my_side2;

  side3.setAttribute("style", "padding: 15px; text-align:center; display:none; color:blue");
  // side3.setAttribute("style", "padding: 15px; text-align:center; color:blue display:none;");
  side3.textContent = text.my_side3;

  del.className = "fas fa-minus";
  del.addEventListener("click", () => {
    contentArray.splice(delThisIndex, 1);
    localStorage.setItem('items', JSON.stringify(contentArray));
    window.location.reload();
  })

  flashcard.appendChild(side1);
  flashcard.appendChild(side2);
  flashcard.appendChild(side3);
  flashcard.appendChild(del);

  flashcard.addEventListener("click", () => {
    if(side2.style.display == "none")
      side2.style.display = "block";
      else
        if(side3.style.display == "none")
        side3.style.display = "block";
    
  })

  document.querySelector("#flashcards").appendChild(flashcard);
}

contentArray.forEach(flashcardMaker);

addFlashcard = () => {
  const side1 = document.querySelector("#side1");
  const side2 = document.querySelector("#side2");
  const side3 = document.querySelector("#side3");

  let flashcard_info = {
    'my_side1' : side1.value,
    'my_side2'  : side2.value,
    'my_side3'  : side3.value
  }

  contentArray.push(flashcard_info);
  localStorage.setItem('items', JSON.stringify(contentArray));
  flashcardMaker(contentArray[contentArray.length - 1], contentArray.length - 1);
  side1.value = "";
  side2.value = "";
  side3.value = "";
}
