if (window.EventEmitter == null) {
    throw new Error("Event emitter is not loaded, cannot defined sequentializer");
}

// no choice but to defined it this way to supports as many browsers 😂
var Sequentializer = function() {
    this.EE = new EventEmitter()
    this.currentNum = 1
    this.processor = function() {}
}

Sequentializer.prototype.setProcessor = function (processor) {
    this.processor = processor
    return this
}

Sequentializer.prototype.push = function (num, data) {
    const action = function () {
        this.processor(data)
        this.currentNum = num
        this.fire()
    }.bind(this)

    this.EE.once(num, action);
    return this
}

Sequentializer.prototype.fire = function () {
    this.EE.emit(this.currentNum + 1)
    return this
}
