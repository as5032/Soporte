function StandardText(field) {
	remove_XS_whitespace(field);
	ChangeTextDown(field);
	StrangerCharacters(field, '');
	DobleEspacio(field);
}


function remove_XS_whitespace(field) {
	var tmp = "";
	var field_length = field.value.length;
	var field_length_minus_1 = field.value.length - 1;
	for (index = 0; index < field_length; index++) {
		if (field.value.charAt(index) != ' ') {
			tmp += field.value.charAt(index);
		}
		else {
			if (tmp.length > 0) {
				if (field.value.charAt(index + 1) != ' ' && index != field_length_minus_1) {
					tmp += field.value.charAt(index);
				}
			}
		}
	}
	field.value = tmp;
}

function StrangerCharacters(field, AddCharacter) {
	var strValid = "ÔÂÊÎÛÇ<>#/+'|¬°[]{}^`´ÀÈÌÒÙÜÄËÏÖ";
	if (AddCharacter != '') {
		strValid += AddCharacter;
	}

	var regex = new RegExp('[' + strValid.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&') + ']', 'g'); // Escapar caracteres especiales en el regex
	field.value = field.value.replace(regex, ''); // Reemplaza los caracteres inválidos con una cadena vacía
}


function DobleEspacio(field) {
	var intComma;
	var strValor;
	strValor = field.value;
	intComma = strValor.indexOf('  ');
	if (intComma != -1) {
		field.select();
		return false;
	}
}

function ChangeTextDown(field) {
	var strText;
	strText = field.value;
	field.value = strText.toLowerCase()
}