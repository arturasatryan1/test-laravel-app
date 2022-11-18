const Main = {
    init: function () {
        this.events()
    },

    events: function () {
        let self = this;

        $('#bid').on('click', function () {
            let userId = $(this).data('user-id');
            let elemCircle = $('#numberCircle');
            self.fetchBid(userId).then((res) => {
                if (res.status === 200) {
                    elemCircle.removeClass('win');
                    elemCircle.removeClass('lose');

                    if (res.data.isWin) {
                        elemCircle.addClass('win')
                    } else {
                        elemCircle.addClass('lose')
                    }
                    elemCircle.text(res.data.rand)
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
