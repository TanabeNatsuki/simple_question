function send()
{
  alert('メールが送信されました');
}

function back()
{
  var url = document.getElementById('back');
  url.href = document.referrer;
}

 function best()
{
  var date = new Date();
  let goal = new Date();
  goal.setDate(goal.getDate()+(7));
  var day = goal.getDate() - date.getDate();
  if(day == 0)
  {
    point = 10;
    return point;
  }
}
