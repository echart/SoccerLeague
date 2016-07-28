language={
  'welovesoccer':'We love soccer',
  'login':'Entrar'
}
template = $('body').html();
template = template.replace('{welovesoccer}', language.welovesoccer);

$('body').html(template);
