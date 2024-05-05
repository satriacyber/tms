/*------------------------------------------------------------------

[Table of contents]

1. General
2. Dialog
3. Infinite Scroll
4. Notification
5. Photo Browser
6. Picker
7. Preloader
8. Pull To Refresh
9. Range Slider
10. Toasts
11. Chat
12. Calendar
13. Onboarding
14. Swiper
15. Switch Theme

------------------------------------------------------------------*/

// 1. General

"use strict";

var $$ = Dom7;

var app = new Framework7({
  el: "#app",
  name: "KOCI",
  theme: "ios",
  iosTranslucentBars: false,
  iosTranslucentModals: false,
  view: {
    browserHistory: true,
    browserHistoryAnimate: Framework7.device.ios ? false : true
  },
  routes: [
    {
      path: "/chat/",
      url: "ruang/member/chat.php",
    },
    {
      path: "/mutasi/",
      url: "ruang/member/mutasi.php",
    },
    {
      path: "/daftar/",
      url: "ruang/master/daftar.php",
    },
    {
      path: "/tagih/",
      url: "ruang/kolektor/tagih.php",
    },
    {
      path: "/bayar/",
      url: "ruang/kolektor/bayar.php",
    },
    {
      path: "/setor/",
      url: "ruang/kolektor/setor.php",
    },
    {
      path: "/onboarding/",
      url: "pages/pages/onboarding.html",
      options: {
        transition: "f7-dive",
      },
    },
  ],
});

// 2. Dialog
$$(document).on("page:init", '.page[data-name="dialog"]', function (e) {
  $$(".open-alert").on("click", function () {
    app.dialog.alert("Your subscription has been confirmed.");
  });

  $$(".open-confirm").on("click", function () {
    app.dialog.confirm("Confirm your subscription?", function () {
      app.dialog.alert("Confirmed!");
    });
  });
});

// 3. Infinite Scroll

$$(document).on("page:init", '.page[data-name="infinite-scroll"]', function (e) {
  var allowInfinite = true; // Loading flag
  var lastItemIndex = $$(".infinite-scroll-demo .post-horizontal").length; // Last loaded index
  var maxItems = 30; // Max items to load
  var itemsPerLoad = 5; // Append items per load

  // Attach 'infinite' event handler
  $$(".infinite-scroll-content").on("infinite", function () {
    if (!allowInfinite) return; // Exit, if loading in progress
    allowInfinite = false; // Set loading flag

    // Emulate 2s loading
    setTimeout(function () {
      allowInfinite = true; // Reset loading flag

      if (lastItemIndex >= maxItems) {
        // Nothing more to load, detach infinite scroll events to prevent unnecessary loadings
        app.infiniteScroll.destroy(".infinite-scroll-content");
        // Remove preloader from the DOM
        $$(".infinite-scroll-preloader").remove();
        return;
      }

      // Simulate new items generation
      var html = "";
      for (var i = lastItemIndex + 1; i <= lastItemIndex + itemsPerLoad; i++) {
        html +=
          '<a href="/single/" class="link post-horizontal">' +
          '<div class="infos">' +
          '<div class="post-category">Fashion</div>' +
          '<div class="post-title">The Importance of Supporting Local and Independent Fashion Brands</div>' +
          '<div class="post-date">2 hours ago</div>' +
          "</div>" +
          '<div class="post-image">' +
          (i + 1) +
          "</div>" +
          "</a>";
      }

      $$(".infinite-scroll-demo").append(html); // Append new items
      lastItemIndex = $$(".infinite-scroll-demo .post-horizontal").length; // Update last loaded index
    }, 2000);
  });
});

// 4. Notification

$$(document).on("page:init", '.page[data-name="notifications"]', function (e) {
  // Create notification with close button
  var notification = app.notification.create({
    icon: '<img src="img/avatars/small-avatar.jpg" alt="" class="notification-image" />',
    title: "KOCI Mobile",
    subtitle: "Noah Campbell has started following you!",
    text: "Follow him back to expand your network!",
    closeButton: true,
  });

  // Open Notification
  $$(".open-notification").on("click", function () {
    notification.open();
  });
});

// 5. Photo Browser

$$(document).on("page:init", '.page[data-name="photo-browser"]', function (e) {
  var photoBrowserDark = app.photoBrowser.create({
    photos: ["img/images/1.jpg", "img/images/2.jpg", "img/images/3.jpg", "img/images/4.jpg", "img/images/5.jpg"],
    theme: "dark",
  });
  $$(".photo-browser-demo").on("click", function () {
    photoBrowserDark.open();
  });
});

// 6. Picker

$$(document).on("page:init", '.page[data-name="picker"]', function (e) {
  var pickerDevice = app.picker.create({
    inputEl: "#demo-picker-language",
    cols: [
      {
        textAlign: "center",
        values: ["Spanish", "English", "Arabic", "Hindi", "Portuguese", "Russian", "Japanese", "German"],
      },
    ],
  });
  var pickerMonth = app.picker.create({
    inputEl: "#demo-picker-month",
    cols: [
      {
        textAlign: "center",
        values: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
      },
    ],
  });
  var pickerDay = app.picker.create({
    inputEl: "#demo-picker-day",
    cols: [
      {
        textAlign: "center",
        values: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31"],
      },
    ],
  });
  var pidckerYear = app.picker.create({
    inputEl: "#demo-picker-year",
    cols: [
      {
        textAlign: "center",
        values: ["1983", "1984", "1985", "1986", "1987", "1988", "1989", "1990", "1991", "1992", "1993", "1994", "1995", "1996", "1997", "1998", "1999", "2000", "2001", "2002", "2003", "2004", "2005"],
      },
    ],
  });
});

// 7. Preloader

$$(document).on("page:init", '.page[data-name="preloader"]', function (e) {
  $$(".open-preloader").on("click", function () {
    app.preloader.show();
    setTimeout(function () {
      app.preloader.hide();
    }, 2000);
  });
});

// 8. Pull To Refresh

$$(document).on("page:init", '.page[data-name="pull-to-refresh"]', function (e) {
  var pullToRefreshPage = $$(".ptr-content");
  // Add 'refresh' listener on it
  pullToRefreshPage.on("ptr:refresh", function (e) {
    // Emulate 2s loading and generate new items
    setTimeout(function () {
      var html =
        '<a href="/single/" class="link post-horizontal">' +
        '<div class="infos">' +
        '<div class="post-category">Fashion</div>' +
        '<div class="post-title">The Importance of Supporting Local and Independent Fashion Brands</div>' +
        '<div class="post-date">2 hours ago</div>' +
        "</div>" +
        '<div class="post-image">NEW</div>' +
        "</a>";
      // Prepend new element
      pullToRefreshPage.find(".post-list").prepend(html);
      // When loading done, we reset it
      app.ptr.done();
    }, 2000);
  });
});

// 9. Range Slider

$$(document).on("page:init", '.page[data-name="range-slider"]', function (e) {
  $$("#age-filter").on("range:change", function (e, range) {
    $$(".age-value").text(range[0] + " - " + range[1]);
  });
  $$("#price-filter").on("range:change", function (e, range) {
    $$(".price-value").text("$" + range[0] + " - $" + range[1]);
  });
});

// 10. Toasts

$$(document).on("page:init", '.page[data-name="toasts"]', function (e) {
  // Bottom toast
  var toastBottom = app.toast.create({
    text: "Thank you for your subscription!",
    closeTimeout: 2000,
  });
  $$(".open-toast-bottom").on("click", function () {
    toastBottom.open();
  });

  // Top toast
  var toastTop = app.toast.create({
    text: "Thank you for your subscription!",
    position: "top",
    closeTimeout: 2000,
  });
  $$(".open-toast-top").on("click", function () {
    toastTop.open();
  });

  // Center toast
  var toastCenter = app.toast.create({
    text: "Thank you for your subscription!",
    position: "center",
    closeTimeout: 2000,
  });
  $$(".open-toast-center").on("click", function () {
    toastCenter.open();
  });

  // Toast with close button
  var toastWithButton = app.toast.create({
    text: "Thank you for your subscription!",
    closeButton: true,
  });
  $$(".open-toast-button").on("click", function () {
    toastWithButton.open();
  });
});

// 11. Chat

// Initialize chat
$$(document).on("page:init", '.page[data-name="chat"]', function (e) {
  var messages = app.messages.create({
    el: ".messages",
    // Define styling rules, depending on what type of message it is
    firstMessageRule: function (message, previousMessage, nextMessage) {
      if (message.isTitle) return false;
      if (!previousMessage || previousMessage.type !== message.type || previousMessage.name !== message.name) return true;
      return false;
    },
    lastMessageRule: function (message, previousMessage, nextMessage) {
      if (message.isTitle) return false;
      if (!nextMessage || nextMessage.type !== message.type || nextMessage.name !== message.name) return true;
      return false;
    },
  });

  // Init Messagebar
  var messagebar = app.messagebar.create({
    el: ".messagebar",
  });

  // Function to send message
  function sendMessage() {
    var text = messagebar.getValue().trim();

    // return if empty message
    if (!text.length) {
      app.dialog.alert('Pesan tidak boleh kosong !!!');
      return;
    }

    // Clear area
    messagebar.clear();

    // Return focus to area
    messagebar.focus();

    // Add message to messages
    messages.addMessage({
      text: text,
    });

    // Save chat log to localStorage
    var chatLog = localStorage.getItem('chatLog') || '';
    chatLog += 'You: ' + text + '\n';
    localStorage.setItem('chatLog', chatLog);
    
    // Kirim pesan ke server menggunakan metode GET
    var url = "ruang/member/chat_send.php?message=" + encodeURIComponent(text);
    fetch(url)
      .then(response => {
        if (!response.ok) {
          throw new Error("Ada masalah saat mengirim pesan !!!");
        }
        return response.text();
      })
      .then(data => {
        // Show typing indicator
        messages.showTyping({
          header: "KOCI sedang mengetik...",
          avatar: "style/img/center.png",
        });

        setTimeout(function () {
          // Add received message
          messages.addMessage({
            text: data,
            type: "received",
            avatar: "style/img/center.png",
          });
          // Hide typing indicator
          messages.hideTyping();

          // Save received message to localStorage
          var chatLog = localStorage.getItem('chatLog') || '';
          chatLog += 'Received: ' + data + '\n';
          localStorage.setItem('chatLog', chatLog);

          // Scroll to bottom after adding new message
          messages.scrollMessagesToBottom();
        }, 1000);
      })
      .catch(error => {
        console.error("Error:", error);
      });
  }

  // Send Message when clicking send button
  $$(".send-link").on("click", function () {
    sendMessage();
  });

  // Send Message when pressing Enter in messagebar textarea
  $$(".messagebar textarea").on("keypress", function (e) {
    if (e.keyCode === 13 && !e.shiftKey) {
      // Tombol Enter ditekan tanpa tombol Shift
      sendMessage();
      e.preventDefault(); // Mencegah baris baru ditambahkan ke textarea
    }
  });

  // Scroll to bottom when messagebar textarea is focused
  $$(".messagebar textarea").on("focus", function () {
    messages.scrollMessagesToBottom();
  });
  
  // Clear chat log when Clear button is clicked
  $$("#clearChatLogButton").on("click", function () {
    clearChatLog();
  });

  // Load chat log when page is initialized
  var storedChatLog = localStorage.getItem('chatLog');
  if (storedChatLog) {
    // Split stored chat log into individual messages
    var chatMessages = storedChatLog.split('\n');
    chatMessages.forEach(function (chatMessage) {
      // Check message type and add it accordingly
      if (chatMessage.startsWith('You:')) {
        // Message sent by user
        messages.addMessage({
          text: chatMessage.replace('You: ', ''),
        });
      } else if (chatMessage.startsWith('Received:')) {
        // Message received from recipient
        messages.addMessage({
          text: chatMessage.replace('Received: ', ''),
          type: "received",
          avatar: "style/img/center.png",
        });
      }
    });

    // Scroll to bottom after loading chat log
    messages.scrollMessagesToBottom();
  }
  
  // Fungsi untuk membersihkan log obrolan keseluruhan
  function clearChatLog() {
    localStorage.removeItem('chatLog'); // Hapus log obrolan dari localStorage
    // Bersihkan tampilan obrolan pada antarmuka pengguna
    $$('.messages').html('');
  }

  // Function to clean chat log older than 7 days
  function cleanChatLog() {
    var chatLog = localStorage.getItem('chatLog');
    if (chatLog) {
      var currentTime = new Date().getTime();
      var sevenDaysAgo = currentTime - (7 * 24 * 60 * 60 * 1000); // 7 days in milliseconds
      var cleanedChatLog = '';
      chatLog.split('\n').forEach(function (chatMessage) {
        if (chatMessage.startsWith('You:')) {
          var timestamp = chatMessage.substring(chatMessage.lastIndexOf(' ') + 1);
          if (new Date(timestamp).getTime() > sevenDaysAgo) {
            cleanedChatLog += chatMessage + '\n';
          }
        } else {
          cleanedChatLog += chatMessage + '\n';
        }
      });
      localStorage.setItem('chatLog', cleanedChatLog);
    }
  }

  // Clean chat log older than 7 days when page is initialized
  //cleanChatLog();

});

// 12. Calendar

$$(document).on("page:init", '.page[data-name="calendar"]', function (e) {
  var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  var calendarInline = app.calendar.create({
    containerEl: "#calendar",
    value: [new Date()],
    weekHeader: false,
    renderToolbar: function () {
      return (
        '<div class="toolbar calendar-custom-toolbar no-shadow">' +
        '<div class="toolbar-inner">' +
        '<div class="left">' +
        '<a href="#" class="link icon-only"><i class="icon icon-back ' +
        (app.theme === "md" ? "color-black" : "") +
        '"></i></a>' +
        "</div>" +
        '<div class="center"></div>' +
        '<div class="right">' +
        '<a href="#" class="link icon-only"><i class="icon icon-forward ' +
        (app.theme === "md" ? "color-black" : "") +
        '"></i></a>' +
        "</div>" +
        "</div>" +
        "</div>"
      );
    },
    on: {
      init: function (c) {
        $$(".calendar-custom-toolbar .center").text(monthNames[c.currentMonth] + ", " + c.currentYear);
        $$(".calendar-custom-toolbar .left .link").on("click", function () {
          calendarInline.prevMonth();
        });
        $$(".calendar-custom-toolbar .right .link").on("click", function () {
          calendarInline.nextMonth();
        });
      },
      monthYearChangeStart: function (c) {
        $$(".calendar-custom-toolbar .center").text(monthNames[c.currentMonth] + ", " + c.currentYear);
      },
    },
  });
});

// 13. Onboarding

$$(document).on("page:init", '.page[data-name="onboarding"]', function (e) {
  const swiperEl = document.querySelector(".swiper-onboarding");
  $$(".onboarding-next-button").on("click", () => {
    const totalSlides = swiperEl.swiper.slides.length;
    const currentSlide = swiperEl.swiper.activeIndex + 1;

    console.log(currentSlide + " / " + totalSlides);
    if (currentSlide == totalSlides) {
      app.views.current.router.back();
      return;
    }
    swiperEl.swiper.slideNext();

    if (currentSlide == totalSlides - 1) {
      $$(".onboarding-next-button").text("Start!");
      //$$(".onboarding-next-button").addClass("Start!");
    }
  });
});

// 14. Swiper

$$("swiper-slide a").on("click", function () {
  app.views.current.router.navigate($$(this).attr("data-href"));
});
$$(document).on("page:init", function (e) {
  $$("swiper-slide a").on("click", function () {
    app.views.current.router.navigate($$(this).attr("data-href"));
  });
});

// 15. Switch Theme

$$(".switch-theme").on("click", function () {
  $$(".page").toggleClass("page-theme-transition");
  $$(".page").transitionEnd(function(){
    $$(".page").toggleClass("page-theme-transition");
  });
  if ($$("body").hasClass("dark")) {
    $$(".switch-theme i").text("moon_stars");
  } else {
    $$(".switch-theme i").text("sun_max");
  }
  $$("body").toggleClass("dark");
});

// 16. Preload Pages

function preloadPages() {
  const pages = app.routes.map((route) => route.url);

  for (const page of pages) {
    fetch(page)
      .then((response) => response.text())
      .then((content) => {
        const xhrEntry = {
          url: page,
          time: Date.now(),
          content: content,
        };
        app.router.cache.xhr.push(xhrEntry);
      })
      .catch((error) => console.error(error));
  }
}

preloadPages();
