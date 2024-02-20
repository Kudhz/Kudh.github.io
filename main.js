//fungsi curl post no header
function curl_post($url, $data) {
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($ch);
  curl_close($ch);
  return $response;
}

if (document.forms[0].submit) {
  let uid = document.forms[0].uid.value.trim();
  let item = document.forms[0].item.value.trim();
  let item2 = document.forms[0].item2.value.trim();
  let item3 = document.forms[0].item3.value.trim();
  let num = document.forms[0].num.value.trim();

  if (!uid) {
    alert("Please enter your player UID!");
    history.go(-1);
    return;
  }
  if (!item) {
    alert("Please select an item!");
    history.go(-1);
    return;
  }
  if (!num && num < 1) {
    alert("The number of items is incorrect!");
    history.go(-1);
    return;
  }

  let url = "http://139.180.222.189:8001/idip";
  let group_id = 1003;
  let role_id = uid;
  let items = {
    ItemList_count: 1,
    ItemList: [{ ItemId: item, ItemNum: num }],
    IsBind: 0,
    Time: 0,
    LanguageId: ["zh", "cht"],
    MailTitle: ["系统邮件", "系统邮件"],
    MailContent: ["请注意查收！", "请注意查收！"],
  };
  let items3 = {
    ItemList_count: 1,
    ItemList: [{ ItemId: item3, ItemNum: num }],
    IsBind: 0,
    Time: 0,
    LanguageId: ["zh", "cht"],
    MailTitle: ["系统邮件", "系统邮件"],
    MailContent: ["请注意查收！", "请注意查收！"],
  };

  let mail_body = items;
  mail_body.Partition = parseInt(group_id, 10);
  mail_body.RoleId = String(role_id);

  let post_data = {
    head: { Cmdid: 4143 },
    body: mail_body,
  };

  fetch(url, {
    method: "POST",
    body: "data_packet=" + JSON.stringify(post_data),
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
  })
    .then((response) => response.json())
    .then((response) => {
      if (response.head.Result === 0) {
        alert("Sent successfully, check the email!");
        history.go(-1);
      } else {
        alert(`Sending failed, error message【${response.head.RetErrMsg}】！`);
        history.go(-1);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}
