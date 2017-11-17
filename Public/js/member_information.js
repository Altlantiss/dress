$.ajax({
  type: "post",
  url: "http://www.study.com/index.php/home/login/login",
  dataType: "json",
  success: function (data) {
    console.log(data);
  },
  error: function (xhr, err) {
    console.log(xhr, err)
    console.log("没有获取数据");
  }
});