if (window.Sequentializer == null) {
  throw new Error("Sequentializer is not loaded, import common.js first!");
}

function InitContentLoader(url, renderFn) {
  let mentok = false;
  let page = 1;

  const u = url instanceof URL == false ? new URL(document.URL) : url;

  $(window).scroll(function () {
    if (
      $(window).scrollTop() + $(window).height() >=
      $(document).height() - 300
    ) {
      if (!mentok) {
        page++;
        loadMoreData(page);
      }
    }
  });
  $(".loader").hide();

  const Seq = new Sequentializer().setProcessor(renderFn);
  function loadMoreData(page) {
    const _u = new URL(u.href);
    _u.searchParams.set("page", page)
    $.ajax({
      url: _u.toString(),
      type: "GET",
      beforeSend: function () {
        $(".loader").show();
      },
    })
      .done(function (data) {
        const contents = data?.data;
        if (contents == null) {
          throw new Error("No data received from the server!");
        }

        Seq.push(page, contents);
        Seq.fire();

        if (contents.length <= 0) {
          mentok = true;
        }
        $(".loader").hide();
      })
      .fail(function (jqXHR, ajaxOptions, thrownError) {
        alert("server not responding...");
      });
  }
}
