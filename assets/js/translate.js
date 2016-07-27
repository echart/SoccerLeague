content = $('.content').html();
content = content.replace('{Nickname}', character.nickname);
content = content.replace('{CharacterClass}', _this.formatClass(character.characterClass, character.gender));
content = content.replace('{Strength}', character.strength);
content = content.replace('{Constitution}', character.constitution);
content = content.replace('{Dexterity}', character.dexterity);
content = content.replace('{Intelligence}', character.intelligence);
content = content.replace('{Charisma}', character.charisma);
content = content.replace('{ClassImg}', character.characterClass);

characterList.append('<div class="character" data-character-id="'+character._id+'">'+content+'</div>');
