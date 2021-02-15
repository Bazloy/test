$(document).ready(function(){
	let modal = document.getElementById("modalO");
	let btn = document.getElementById("VBtn");
	let span = document.getElementsByClassName("close")[0];

	btn.onclick = function(){
		
		modal.style.display = "block";
		
	}

	span.onclick = function(){
		
		modal.style.display = "none";
		
	}

	window.onclick = function(event){
		
		if(event.target == modal){
			
			modal.style.display = "none";
			
		}
		
	}
	
	let modalR = document.getElementById("regFormD");
	let modalG = document.getElementById("zagGameF");
	let modalI = document.getElementById("zagMatF");
	let modalT = document.getElementById("TableF");
	
	let btnR = document.getElementById("RedInform");
	let btnG = document.getElementById("ZagGames");
	let btnI = document.getElementById("ZagInform");
	let btnT = document.getElementById("MyFile");
	
	btnR.onclick = function(){
		
		modalR.style.display = "block";
		modalG.style.display = "none";
		modalI.style.display = "none";
		modalT.style.display = "none";
		
	}
	
	btnG.onclick = function(){
		
		modalR.style.display = "none";
		modalG.style.display = "block";
		modalI.style.display = "none";
		modalT.style.display = "none";
		
	}
	
	btnI.onclick = function(){
		
		modalR.style.display = "none";
		modalG.style.display = "none";
		modalI.style.display = "block";
		modalT.style.display = "none";
		
	}
	
	btnT.onclick = function(){
		
		modalR.style.display = "none";
		modalG.style.display = "none";
		modalI.style.display = "none";
		modalT.style.display = "block";
		
	}
	
});


$(document).ready(function(){
	$("#RegInformP").click(function(){
		
		let modalR = document.getElementById("regForm");
		$("#messegeShow").hide();
		
		let login = $("#Login").val();
		let Pass = $("#Pass").val();
		let Name = $("#Name").val();
		let SurName = $("#SurName").val();
		let Email = $("#Email").val();
		let City = $("#City").val();
		let Id = $("#ID").val();
		let fail = "";
		
		
		if(login.length == 0 || Pass.length == 0 || Name.length == 0 || SurName.length == 0 || Email.length == 0){
			fail = "Не заполнены обязательные поля";
		}else if(login.length < 3){
			fail = "Логин меньше 3 символов";
		}else if(Pass.length < 6){
			fail = "Пароль меньше 6 символов";
		}else if(Email.split ('@').length - 1 == 0 || Email.split ('.').length - 1 == 0){
			fail = "Некоректный Email";
		}else if(Name.length == 0){
			fail = "Не заполнено имя";
		}else if(SurName.length == 0){
			fail = "Не заполнена фамилия";
		};
		
		if(fail != ""){
			$("#messegeShow").html (fail);
			$("#messegeShow").show();
			alert(fail);
			return false;
		};
		
		$.ajax({
			url: '/modules/function/red.php',
			type: 'POST',
			cache: false,
			data: {Id: Id,
			Login: login,
			Pass: Pass,
			Email: Email,
			Name: Name,
			SurName: SurName,
			City: City
			},
			dataType: 'text',
			success: function(data){
				console.log(data);
				if(data == "Данные успешно измененны"){
					$("#messegeShow").html (data);
					$("#messegeShow").show();
					modalR.style.display = "none";
					alert(data);
				}
			}
		});
		
	});
});


$(document).ready(function(){
	$("#RegBtn").click(function(){
		
		$("#messegeShow").hide();
		
		let login = $("#Login").val();
		let Pass = $("#Pass").val();
		let Name = $("#Name").val();
		let SurName = $("#SurName").val();
		let Email = $("#Email").val();
		let City = $("#City").val();
		let fail = "";
		
		if(login.length == 0 || Pass.length == 0 || Name.length == 0 || SurName.length == 0 || Email.length == 0){
			fail = "Не заполнены обязательные поля";
		}else if(login.length < 3){
			fail = "Логин меньше 3 символов";
		}else if(Pass.length < 6){
			fail = "Пароль меньше 6 символов";
		}else if(Email.split ('@').length - 1 == 0 || Email.split ('.').length - 1 == 0){
			fail = "Некоректный Email";
		}else if(Name.length == 0){
			fail = "Не заполнено имя";
		}else if(SurName.length == 0){
			fail = "Не заполнена фамилия";
		};
		
		if(fail != ""){
			$("#messegeShow").html (fail);
			$("#messegeShow").show();
			return false;
		};
		
		$.ajax({
			url: 'modules/function/reg.php',
			type: 'POST',
			cache: false,
			data: {Login: login,
			Pass: Pass,
			Email: Email,
			Name: Name,
			SurName: SurName,
			City: City
			},
			dataType: 'text',
			success: function(data){
				console.log(data);
				if(data == "Регистрация прошла успешно"){
					$("#messegeShow").html (data);
					$("#messegeShow").show();
				}
			}
		});
		
	});
});



$(document).ready(function(){
	$("#VBtnF").click(function(){
		$("#messegeShow").hide();
		
		let login = $("#LoginA").val();
		let Pass = $("#PassA").val();
		let fail = "";
		
		if(login.length == 0 || Pass.length == 0){
			fail = "Не заполнены обязательные поля";
		}
		
		if(fail != ""){
			$("#messegeShow").html (fail);
			$("#messegeShow").show();
			return false;
		};
		
		$.ajax({
			url: '/modules/function/auto.php',
			type: 'POST',
			cache: false,
			data: {Login: login,
			Pass: Pass
			},
			dataType: 'text',
			success: function(data){
				if(data == "Логин/пароль введенны не верно" || data == "Не введен пароль"){
					$("#messegeShow").html (data);
					$("#messegeShow").show();
				}else if(data == "Авторизация"){				
					document.location.replace("/modules/user/profile.php");
				}
			}
		});
	});
});

$(document).ready(function(){
	$("#СBtn").click(function(){
		$.ajax({
			url: '/modules/function/logout.php',
			type: 'POST',
			cache: false,
			data: {
			},
			dataType: 'text',
			success: function(data){
				document.location.replace("/index.php");
			}
		});
	});
});