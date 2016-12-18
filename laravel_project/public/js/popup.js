var texts = new Array();
texts[0] = "To evolve as a <b>Solar Dominator</b> you need to take care of your fleet!";
texts[1] = "Be shure to check <b>regularly</b> your home page for attack messages !";
texts[2] = "Just a friendly reminder: <b>You are awesome!</b>";
texts[3] = "Be careful when attacking with <b>all your ships</b> , you may be attack too.";
texts[4] = "Dude , the weather is great , <b>go outside</b> and get some sunshine!";
texts[5] = "Money makes the World go round , so does the gold, metal and energy , <b>Upgrade</b> your buildings.";
texts[6] = "You are cool and everything but you should change your <b>Profile</b> picture. . .";
texts[7] = "You can check your <b>Battle Logs</b>, they are in your Home Page. They will be visable after your first battle.";
texts[8] = "Upgrade buildings , create ships , attack , evolve - you're gonna be the <b>Solar Dominator</b>";
texts[9] = "If you lose some battles , <b>don't worry</b> , after all this is just a game. ";
texts[10] = "Go to Radar and find your next <b>victim</b>.";
texts[11] = "<b>Offence</b> is the best <b>defence</b>. Strike them first !";
texts[12] = "If you want to be the <b>best</b> just be the best !";
texts[13] = "Daaamn , you have <b>lovely</b> eyes. . .";
texts[14] = "I've heard that the assault carriers are the <b>best</b>, but you need <b>level 5</b> Shipyard . . .";



var catchText3;

var promoCount;

function showHydeWin(mode, vell){
	//the mode is if we + the opacity , or we - the opacity
	var showVell = vell; // the vell is the portion of the opacity to be removed every few milliseconds
	
	var theWindow = document.getElementById("popWindow");

	
	var opStart;
	var opEnd;
	
	if(mode === "+"){
		opStart = 0;
		opEnd = 1;
	}else if(mode === "-"){
		opStart = 1;
		opEnd = 0;
		showVell = -vell;
	}else{
		return;
	}
	
	var count = opStart;
	
	// this part is for the "magical" pop-up
	var showLoop = setInterval(function(){
		
		theWindow.style.opacity = count;
		count += showVell;
		
		if(mode === "+"){
			if(count > opEnd){
				theWindow.style.opacity = opEnd;
				clearInterval(showLoop);
			}
		}else if(mode === "-"){
			if(count < opEnd){
				theWindow.style.opacity = opEnd;
				clearInterval(showLoop);
				return;
			}
		}
	
	},17);
	
};

function genRandNum(min, max){
	var count = Math.floor((Math.random() * (max-min)) + min);
	return count;
};

function showBoxTime(sec, vell){
	showHydeWin("+", vell);
	var n = 0;
	var showLoop = setInterval(function(){
		if(n > sec){
			showHydeWin("-", vell);
			clearInterval(showLoop);
			return;
		}
		n ++;
	},1000);
};

function insertText(){
	var textToShow = genRandNum(0, texts.length);
	var popWindow = document.getElementById("popWindow");

	popWindow.innerHTML = '<p id="popUpMessage">'+ texts[textToShow] +'</span>';

}


setInterval(
	function(){
		insertText(); // adding new message
		showBoxTime(12, 0.05); // poping-up

}, 30000); // every 30 sec


