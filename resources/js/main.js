const Main = {
    init: function () {
        this.events()
    },

    events: function () {
        let self = this;

        $('#bid').on('click', function () {
            let userId = $(this).data('user-id');
            let bidResult = $('#bidResult');
            self.fetchBid(userId).then((res) => {
                if (res.status === 200) {
                    bidResult.removeClass('win');
                    bidResult.removeClass('lose');
                    if (res.data.isWin) {
                        bidResult.html(`You Win ${res.data.value.toFixed(2)}`);
                        bidResult.addClass('win')
                    } else {
                        bidResult.html(`You Lose`);
                        bidResult.addClass('lose')
                    }
                }
            })
        });

        $('#history').on('click', function () {
            let userId = $(this).data('user-id');
            self.fetchHistory(userId).then((res) => {
                if (res.status === 200) {
                    let html = res.data.html;
                    $('#history-data').html(html);
                }
            })
        })
    },

    fetchBid: async function (userId) {
        return await axios.get(`/bid/${userId}`)
    },
    fetchHistory: async function (userId) {
        return await axios.get(`/bid/history/${userId}`)
    }
};

window.onload = () => {
    Main.init();
};
