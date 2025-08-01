<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <style>
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Cormorant Garamond', serif !important;
        }

        .chatbot-btn {
            background-color: #6C3B9B;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            border: none;
            color: white;
            padding: 12px 20px;
            border-radius: 25px 5px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s ease;
            position: fixed;
            bottom: 20px;
            right: 20px;
        }

        .chatbot-btn:hover {
            background-color: #5a2f82;
            transform: translateY(-2px);
        }

        .chat-content {

            border-radius: 1.5rem 0.5rem;
            background-color: rgba(255, 255, 255);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .chat-header {
            position: sticky;
            /* Stay on top */
            top: 0;
            z-index: 10;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #6C3B9B;
            padding: 1rem;
            backdrop-filter: blur(12px);
            /* Blur effect */
            -webkit-backdrop-filter: blur(12px);
            /* Safari */
            background-color: rgba(255, 255, 255, 0.3);
            /* Transparent white */
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .chat-logo {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
            background: #6C3B9B;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .chat-body.chat-body {
            max-height: 80vh;
            overflow-y: auto;
            padding: 0;
            scrollbar-width: thin;
            scrollbar-color: #6C3B9B transparent;
        }

        .chat-body.chat-body::-webkit-scrollbar {
            width: 6px;
        }

        .chat-body.chat-body::-webkit-scrollbar-track {
            background: transparent;
        }

        .chat-body.chat-body::-webkit-scrollbar-thumb {
            background-color: #6C3B9B;
            border-radius: 3px;
            opacity: 0.7;
        }

        .chat-body.chat-body::-webkit-scrollbar-thumb:hover {
            background-color: #5a2f82;
        }

        .message-incoming,
        .message-outgoing {
            max-width: 75%;
            padding: 0.8rem 1rem;
            border-radius: 1rem;
            margin-bottom: 1rem;
            position: relative;
            font-size: 0.9rem;
            line-height: 1.4;
            word-wrap: break-word;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .message-incoming {
            background: rgba(255, 255, 255, 0.9);
            margin: auto 10px 10px 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            color: #333;
        }

        .message-outgoing {
            background-color: #6C3B9B;
            color: white;
            margin: 10px 10px 10px 13.5vb;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .timestamp {
            font-size: 0.7rem;
            color: #666;
            margin-top: 4px;
            text-align: right;
        }

        .message-outgoing .timestamp {
            color: rgba(255, 255, 255, 0.7);
        }

        .chat-footer {
            border-top: none;
            padding: 0.8rem 1rem;
            background: transparent;
        }

        .chat-footer .input-group {
            display: flex;
            border-radius: 2rem;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .message-input {
            border: none;
            padding: 0.8rem 1rem;
            flex: 1;
            background: rgba(255, 255, 255, 0.9);
            outline: none;
            font-size: 14px;
        }

        .message-input::placeholder {
            color: #999;
        }

        .send-btn {
            background-color: #6C3B9B;
            color: white;
            border: none;
            padding: 0.8rem 1.2rem;
            transition: background 0.3s;
            cursor: pointer;
        }

        .send-btn:hover {
            background-color: #5a2f82;
        }

        .send-btn:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        /* Fixed positioning */
        .chat-widget {
            position: fixed;
            top: 8%;
            right: 1%;
            width: 400px;
            z-index: 1050;
            display: none;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 24px;
            color: #6C3B9B;
            cursor: pointer;
            padding: 5px;
            margin-left: auto;
        }

        .close-btn:hover {
            color: #5a2f82;
        }

        .demo-content {
            margin-left: 400px;
            padding: 20px;
            color: white;
        }

        .typing-indicator {
            display: none;
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 1rem;
            margin-bottom: 1rem;
            width: fit-content;
            color: #666;
        }

        .typing-dots {
            display: inline-block;
        }

        .typing-dots span {
            display: inline-block;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background-color: #6C3B9B;
            margin: 0 2px;
            animation: typing 1.4s infinite;
        }

        .typing-dots span:nth-child(2) {
            animation-delay: 0.2s;
        }

        .typing-dots span:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes typing {

            0%,
            60%,
            100% {
                transform: translateY(0);
            }

            30% {
                transform: translateY(-10px);
            }
        }

        .icon-bg {
            background: url('assets/icons/chatbot.svg') no-repeat center;
            background-size: contain;
            width: 32px;
            height: 32px;
        }

        .blur-box {
            backdrop-filter: blur(10px);
            /* Main blur effect */
            -webkit-backdrop-filter: blur(10px);
            /* For Safari */
            background-color: rgba(255, 255, 255, 0.3);
            /* Optional semi-transparent bg */
            border-radius: 12px;
            padding: 20px;
        }


        .product-carousel {
            margin: 10px 0;
            overflow: hidden;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .carousel-container {
            display: flex;
            transition: transform 0.4s ease-in-out;
            gap: 15px;
            padding: 15px;
        }

        .chat-content .product-card {
            min-width: 220px;
            background: white;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #f0f0f0;
            position: relative;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .chat-content .product-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            width: 100%;
            height: 160px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            margin-bottom: 10px;
            position: relative;
            overflow: hidden;
        }

        .product-title {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .product-subtitle {
            font-size: 12px;
            color: #666;
            margin-bottom: 12px;
        }

        .explore-btn {
            background: #6C3B9B;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            cursor: pointer;
            transition: background 0.2s ease;
            width: 100%;
        }

        .explore-btn:hover {
            background: #5a2f82;
        }

        .carousel-controls {
            display: flex;
            justify-content: center;
            gap: 10px;
            padding: 10px;
            background: rgba(255, 255, 255, 0.9);
        }

        .carousel-btn {
            background: #6C3B9B;
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .carousel-btn:hover {
            background: #5a2f82;
            transform: scale(1.1);
        }

        .carousel-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: scale(1);
        }

        .carousel-dots {
            display: flex;
            justify-content: center;
            gap: 6px;
            padding: 10px;
        }

        .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #ddd;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .dot.active {
            background-color: #6C3B9B;
        }

        /* Container styles */
        .menu-wrapper {
            position: relative;
            display: inline-block;
            font-family: Arial, sans-serif;
        }

        /* Trigger button */
        .menu-trigger {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background-color: transparent;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            gap: 2px;
            margin: 5px;
        }

        .menu-trigger .dot {
            width: 4px;
            height: 4px;
            background-color: black;
            border-radius: 50%;
        }

        /* Dropdown styles */
        .chat-content .menu-dropdown {
            display: none;
            position: absolute;
            top: 35px;
            right: 0;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
            min-width: 180px;
            overflow: hidden;
            z-index: 1000;
        }

        .chat-content .dropdown-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 30px;
            font-size: 14px;
            color: #333;
            background-color: white;
        }

        .chat-content .dropdown-item.top {
            background-color: #3a3a3a;
            color: white;
        }

        .chat-content .dropdown-item:hover {
            background-color: #f0f0f0;
        }

        /* Toggle switch */
        .switch {
            position: relative;
            display: inline-block;
            width: 34px;
            height: 18px;
            margin-left: 8px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            border-radius: 18px;
            transition: 0.3s;
        }

        .slider::before {
            position: absolute;
            content: "";
            height: 14px;
            width: 14px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            border-radius: 50%;
            transition: 0.3s;
        }

        input:checked+.slider {
            background-color: #2ea44f;
        }

        input:checked+.slider::before {
            transform: translateX(16px);
        }

        @media (max-width: 768px) {
            .chat-widget {
                width: 90%;
                right: 5%;
                top: 10%;
            }

            .chat-body {
                height: 75vh;
            }

            .chatbot-btn {
                right: 10px;
                bottom: 10px;
                padding: 10px 16px;
                font-size: 13px;
            }

            .chat-header h5 {
                font-size: 16px;
            }

            .message-incoming,
            .message-outgoing {
                font-size: 0.85rem;
                padding: 0.6rem 0.8rem;
            }

            .chat-content .product-card {
                min-width: 170px;
                padding: 10px;
            }

            .product-image {
                height: 130px;
                font-size: 30px;
            }

            .product-title {
                font-size: 13px;
            }

            .product-subtitle {
                font-size: 11px;
            }

            .explore-btn {
                font-size: 11px;
                padding: 6px 12px;
            }

            .chat-footer .input-group {
                gap: 10px;
            }

            .message-input {
                width: 100%;
                font-size: 13px;
            }

            .chat-content.dropdown-item {
                padding: 15px 20px;
            }
        }

        @media (max-width: 480px) {

            .chat-content {
                border-radius: 0;
            }

            .chat-body.chat-body {
                height: 100%;
            }

            .message-input {
                width: 80%;
            }

            .send-btn {
                width: 20%;
            }

            .chat-body.chat-body {
                max-height: 90vh;
            }

            .chat-footer .input-group {
                height: 45px;
            }

            .chat-header h5 {
                font-size: 14px;
            }

            .chat-widget {
                width: 100%;
                right: 0;
                top: 0;
                height: 100vh;
                border-radius: 0;
            }

            .chat-content {
                height: 100vh;
                display: flex;
                flex-direction: column;
            }

            .chat-body {
                flex: 1;
            }

            .chat-footer {
                padding-bottom: env(safe-area-inset-bottom, 10px);
            }

            .carousel-btn {
                width: 24px;
                height: 24px;
                font-size: 12px;
            }
        }

        /* Add these styles to your existing CSS */

        /* Chatbot button - ensure it's always clickable */
        .chatbot-btn {
            z-index: 1100 !important;
            /* Higher than navbar */
        }

        /* Chat widget container */
        .chat-widget {
            z-index: 1099 !important;
            /* Just below the button but above navbar */
        }


        @media (min-width: 500px) {
            .chat-content .product-card {
                flex: 0 0 calc(50% - 20px);
            }
        }

        @media (min-width: 768px) {
            .chat-content .product-card {
                flex: 0 0 calc(33.333% - 20px);
            }
        }

        .carousel-container {
            display: flex;
            transition: transform 0.4s ease-in-out;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            gap: 20px;
            padding: 20px;
        }

        .carousel-container::-webkit-scrollbar {
            display: none;
        }

        .chat-content .product-card {
            scroll-snap-align: start;
        }

        @media (max-width: 600px) {
            .message-incoming form {
                display: flex;
                flex-direction: column;
                gap: 10px;
            }
        }

        @media (max-width: 480px) {
            .chat-content {
                height: 100%;
            }

            .chat-body {
                max-height: calc(100vh - 160px);
            }
        }

        .product-carousel {
            overflow: hidden;
            position: relative;
            width: 100%;
        }

        .carousel-container {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .product-card {
            min-width: 200px;
            margin-right: 20px;
        }

        .carousel-dots {
            text-align: center;
            margin-top: 10px;
        }

        .dot {
            height: 10px;
            width: 10px;
            margin: 0 3px;
            display: inline-block;
            background-color: #ccc;
            border-radius: 50%;
            cursor: pointer;
        }

        .dot.active {
            background-color: #000;
        }
    </style>
</head>

<body>
    <button class="chatbot-btn chat-trigger" id="chatToggleBtn" style="z-index: 2000;">
        <span style="margin-right: 8px;">💬</span>
        Ask Question
    </button>

    <!-- Fixed Chatbot Widget -->
    <div class="chat-widget " id="chatWidget">


        <div class="chat-content">
            <div class="chat-body chat-body" id="chatBody">
                <div class="chat-header top-0 w-100 d-flex align-items-center justify-content-between px-3 py-2"
                    style="backdrop-filter: blur(10px); background-color: rgba(255,255,255,0.4); border-bottom: 1px solid rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 10;">

                    <!-- Left: Icon and Bot Name -->
                    <div class="d-flex align-items-center gap-2"
                        style="background-color: white; padding: 10px 16px; border-radius: 20px; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); border: 1px solid #eee;">
                        <img src="<?php echo base_url('assets/Images/chatboticon.svg'); ?>" alt="Chatbot"
                            style="width: 2.5rem;">
                        <h5 class="mb-0 fw-semibold text-dark" style="font-size:28px !important">Sitara</h5>
                    </div>

                    <!-- Right: Dots Menu + Close -->
                    <div class="d-flex align-items-center gap-2">
                        <!-- Three Dots Menu -->
                        <div class="menu-wrapper">
                            <div class="menu-trigger" onclick="toggleDropdown()">
                                <div class="dot"></div>
                                <div class="dot"></div>
                                <div class="dot"></div>
                            </div>

                            <div class="menu-dropdown" id="dropdownMenu">
                                <div class="dropdown-item top">
                                    <span>📧 Send transcript</span>
                                </div>
                                <div class="dropdown-item">
                                    <span>🔊 Sounds</span>
                                    <label class="switch">
                                        <input type="checkbox" checked>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </div>


                        <!-- Close Button -->
                        <button class="close-btn" id="chatCloseBtn"
                            style="background: none; border: none; font-size: 24px; color: #6C3B9B;">&times;</button>
                    </div>
                </div>


                <div class="message-incoming">
                    Hello! I'm Jiva, your AI assistant. How can I help you today?
                    <div class="timestamp">Today 12:00 PM</div>
                </div>
                <div class="message-outgoing">
                    Hi there! I'd like to know more about your services.
                    <div class="timestamp">Today 12:01 PM</div>
                </div>
                <div class="message-incoming">
                    I'd be happy to help! I can assist you with various questions and tasks. What specific area would
                    you like to explore?
                    <div class="timestamp">Today 12:01 PM</div>
                </div>
                <div class="message-outgoing">
                    That sounds great! Can you tell me about your capabilities?
                    <div class="timestamp">Today 12:02 PM</div>
                </div>
                <div class="message-incoming">
                    Absolutely! I can help with information, answer questions, provide explanations, assist with
                    problem-solving, and much more. Feel free to ask me anything!
                    <div class="timestamp">Today 12:02 PM</div>
                </div>
                <div class="typing-indicator" id="typingIndicator">
                    <div class="typing-dots">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
            <div class="chat-footer">
                <div class="input-group">
                    <input type="text" class="message-input" id="messageInput" placeholder="Type your message..."
                        aria-label="Message">
                    <button class="send-btn" type="button" id="sendBtn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            viewBox="0 0 16 16">
                            <path
                                d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm-5.464-4.95 4.338 2.76-5.81 4.132z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>


    <script>
        const chatToggleBtn = document.getElementById('chatToggleBtn');
        const chatWidget = document.getElementById('chatWidget');
        const chatCloseBtn = document.getElementById('chatCloseBtn');
        const messageInput = document.getElementById('messageInput');
        const sendBtn = document.getElementById('sendBtn');
        const chatBody = document.getElementById('chatBody');
        const typingIndicator = document.getElementById('typingIndicator');
        let sendMessageBtn;
        const chatTriggers = document.querySelectorAll('.chat-trigger'); // Use a common class


        let isChatOpen = false; // Add this variable

        function toggleChat() {
            console.log('Chat toggled');
            isChatOpen = !isChatOpen;
            chatWidget.style.display = isChatOpen ? 'block' : 'none';

            if (isChatOpen) {
                messageInput.focus();
                chatToggleBtn.style.display = 'none';
                chatBody.scrollTo({
                    top: chatBody.scrollHeight,
                });
            }
        }
        // Add the toggle functionality to each trigger
        chatTriggers.forEach(trigger => {
            trigger.addEventListener('click', (e) => {
                e.preventDefault(); // Prevent default link behavior
                toggleChat();

            });
        });

        // Close chat widget
        chatCloseBtn.addEventListener('click', (e) => {
            e.preventDefault(); // Prevent default link behavior
            toggleChat();
            chatToggleBtn.style.display = 'block'; // Show the button again

        });

        // Get current time
        function getCurrentTime() {
            const now = new Date();
            return now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        }

        // Create message element
        function createMessage(text, isOutgoing = false) {
            const messageDiv = document.createElement('div');
            messageDiv.className = isOutgoing ? 'message-outgoing' : 'message-incoming';
            messageDiv.innerHTML = `
                ${text}
                <div class="timestamp">Today ${getCurrentTime()}</div>
            `;
            return messageDiv;
        }

        // Add message to chat
        function addMessage(text, isOutgoing = false) {
            const messageElement = createMessage(text, isOutgoing);
            chatBody.insertBefore(messageElement, typingIndicator);
            scrollToBottom();
        }

        // Scroll to bottom
        function scrollToBottom() {
            chatBody.scrollTop = chatBody.scrollHeight;
        }

        // Show typing indicator
        function showTyping() {
            typingIndicator.style.display = 'block';
            scrollToBottom();
        }

        // Hide typing indicator
        function hideTyping() {
            typingIndicator.style.display = 'none';
        }

        // Simulate bot response
        function simulateBotResponse(userMessage) {
            showTyping();

            setTimeout(() => {
                hideTyping();

                // Simple bot responses
                let response = "Thanks for your message! I'm here to help you.";

                if (userMessage.toLowerCase().includes('hello') || userMessage.toLowerCase().includes('hi')) {
                    response = `Hello! Great to meet you. How can I assist you today? Do you want to find your astrogem? fill the following form.<br><br>
                        <input type="text" class="form-control" placeholder="Enter your name" id="name" required>
                        <input type="email" class="form-control mt-2" placeholder="Enter your email" id="email" required>
                        <input type="number" class="form-control mt-2" placeholder="Enter your phone number" id="phone" required>
                        <input type="date" class="form-control mt-2" placeholder="Enter your birth date" id="birthDate" required/>
                         <input type="text" class="form-control mt-2" placeholder="Enter your birth place" id="birthPlace" required/>
                        <div class="d-flex justify-content-end">
                            <button onclick="handleFormSubmission()"  style="background-color:#5a2f82" class="btn btn-primary mt-2" id="sendMessageBtn">Send</button>
                        </div>
                    `;




                } else if (userMessage.toLowerCase().includes('help')) {
                    response = "I'm here to help! You can ask me questions about our services, get information, or just have a conversation.";
                } else if (userMessage.toLowerCase().includes('bye') || userMessage.toLowerCase().includes('goodbye')) {
                    response = "Goodbye! Feel free to come back anytime if you need assistance.";
                }

                addMessage(response, false);
            }, 1000 + Math.random() * 2000);
        }

        function handleFormSubmission() {
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const birthDate = document.getElementById('birthDate').value.trim();

            if (name && email && phone && birthDate) {
                addMessage(`Thank you ${name}! Your details have been submitted successfully.`, false);
                addMessage(`<div id="prod"></div><p>This are the various astrogems that will bring good luck to you.</p>`, false)
                document.getElementById('prod').innerHTML = createProductCarousel();
            } else {
                addMessage("Please fill in all fields.", true);
            }
        }


        //    sendMessageBtn.addEventListener('click', handleFormSubmission);

        // Send message
        function sendMessage() {
            const message = messageInput.value.trim();
            if (message) {
                addMessage(message, true);
                messageInput.value = '';
                simulateBotResponse(message);
            }
        }

        // Send button click
        sendBtn.addEventListener('click', sendMessage);

        // Enter key to send
        messageInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });

        // Disable send button when input is empty
        messageInput.addEventListener('input', () => {
            sendBtn.disabled = !messageInput.value.trim();
        });

        // Initialize
        sendBtn.disabled = true;
        scrollToBottom();


        const products = [
            {
                id: 1,
                title: "Elan",
                subtitle: "Elegant Collection",
                emoji: "<?php echo base_url("assets/Images/astrogem.png") ?> ",
                gradient: "linear-gradient(135deg, #667eea 0%, #764ba2 100%)"
            },
            {
                id: 2,
                title: "Maithili Collection",
                subtitle: "Traditional Designs",
                emoji: "<?php echo base_url("assets/Images/astrogem.png") ?> ",
                gradient: "linear-gradient(135deg, #f093fb 0%, #f5576c 100%)"
            },
            {
                id: 3,
                title: "Nav-Ratni Collection",
                subtitle: "Nine Gems",
                emoji: "<?php echo base_url("assets/Images/astrogem.png") ?> ",
                gradient: "linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)"
            },
            {
                id: 4,
                title: "Modern Polki",
                subtitle: "Contemporary Style",
                emoji: "<?php echo base_url("assets/Images/astrogem.png") ?> ",
                gradient: "linear-gradient(135deg, #43e97b 0%, #38f9d7 100%)"
            },
            {
                id: 5,
                title: "GlamDays",
                subtitle: "Everyday Glam",
                emoji: "<?php echo base_url("assets/Images/astrogem.png") ?> ",
                gradient: "linear-gradient(135deg, #fa709a 0%, #fee140 100%)"
            },
            {
                id: 6,
                title: "Colour Charmes",
                subtitle: "Vibrant Collection",
                emoji: "<?php echo base_url("assets/Images/astrogem.png") ?> ",
                gradient: "linear-gradient(135deg, #a8edea 0%, #fed6e3 100%)"
            },
            {
                id: 7,
                title: "Tanishq GlamDays",
                subtitle: "Premium Range",
                emoji: "<?php echo base_url("assets/Images/astrogem.png") ?> ",
                gradient: "linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%)"
            }
        ];
        let currentSlide = 0;
        const itemsPerSlide = 1;

        function createProductCarousel() {
            const totalSlides = Math.ceil(products.length / itemsPerSlide);

            let carouselHTML = `
        <div class="product-carousel">
            <div class="carousel-container" id="carouselContainer">
    `;

            products.forEach(product => {
                carouselHTML += `
            <div class="product-card" onclick="selectProduct('${product.title}')">
                <div class="product-image" style="background: ${product.gradient};">
                    <img src=${product.emoji} class="product-image"/>
                </div>
                <div class="product-title">${product.title}</div>
                <div class="product-subtitle">${product.subtitle}</div>
                <button class="explore-btn" onclick="event.stopPropagation(); exploreProduct('${product.title}')">
                    Explore Now
                </button>
            </div>
        `;
            });

            carouselHTML += `
            </div>
            <div class="carousel-controls">
                <button class="carousel-btn" id="prevBtn" onclick="previousSlide()">‹</button>
                <button class="carousel-btn" id="nextBtn" onclick="nextSlide()">›</button>
            </div>
            `;



            carouselHTML += `</div>`;

            return carouselHTML;
        }

        // Carousel navigation functions
        function updateCarousel() {
            const card = document.querySelector('.product-card');
            const container = document.getElementById('carouselContainer');

            if (!card || !container) return; // Safety check

            const slideWidth = card.offsetWidth + 20; // card width + gap
            const translateX = -currentSlide * slideWidth * itemsPerSlide;
            container.style.transform = `translateX(${translateX}px)`;

            // Update dots
            document.querySelectorAll('.dot').forEach((dot, index) => {
                dot.classList.toggle('active', index === currentSlide);
            });

            // Update button states
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const totalSlides = Math.ceil(products.length / itemsPerSlide);

            if (prevBtn) prevBtn.disabled = currentSlide === 0;
            if (nextBtn) nextBtn.disabled = currentSlide >= totalSlides - 1;
        }

        function nextSlide() {
            const totalSlides = Math.ceil(products.length / itemsPerSlide);
            if (currentSlide < totalSlides - 1) {
                currentSlide++;
                updateCarousel();
            }
        }

        function previousSlide() {
            if (currentSlide > 0) {
                currentSlide--;
                updateCarousel();
            }
        }

        function goToSlide(index) {
            const totalSlides = Math.ceil(products.length / itemsPerSlide);
            currentSlide = Math.max(0, Math.min(index, totalSlides - 1)); // Clamp to valid range
            updateCarousel();
        }

        function selectProduct(productName) {
            addMessage(`I'm interested in the ${productName} collection! Can you tell me more about it?`, true);
            setTimeout(() => {
                addMessage(`Great choice! The ${productName} collection features exquisite designs. Would you like to see more details or check availability?`, false);
            }, 1000);
        }

        function exploreProduct(productName) {
            addMessage(`I'd like to explore the ${productName} collection`, true);
            setTimeout(() => {
                addMessage(`Perfect! I'll show you the ${productName} collection. Here are some beautiful pieces from this range. Would you like specific details about any item?`, false);
            }, 1000);
        }

        // Initialize carousel
        document.querySelector('.prod').innerHTML = createProductCarousel();

        // Initialize carousel state after DOM is ready
        setTimeout(() => {
            updateCarousel();
        }, 100);
        function toggleDropdown() {
            const dropdown = document.getElementById("dropdownMenu");
            dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
        }

        window.addEventListener("click", function (e) {
            if (!e.target.closest(".menu-wrapper")) {
                document.getElementById("dropdownMenu").style.display = "none";
            }
        });
    </script>
</body>

</html>