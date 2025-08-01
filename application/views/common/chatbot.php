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

    <style>
        .chat-widget {
            position: fixed;
            bottom: 0;
            right: 20px;
            width: 360px;
            height: 85vh;
            z-index: 9999;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
            border-radius: 16px;
            overflow: hidden;
            background-color: #f9f9f9;
            display: none;
            flex-direction: column;
        }

        .chat-content {
            display: flex;
            flex-direction: column;
            height: 100%;
        }



        .chat-body {
            overflow-y: auto;
            padding: 16px 12px 40px;
            display: flex;
            flex-direction: column;
            scroll-behavior: smooth;
            height: calc(85vh - 0px);
            /* Adjust based on actual header + welcome height */
        }

        .chat-body::-webkit-scrollbar {
            width: 6px;
        }

        .chat-body::-webkit-scrollbar-thumb {
            background-color: #ccc;
            border-radius: 3px;
        }

        .chat-body::-webkit-scrollbar-track {
            background: transparent;
        }

        .message-incoming,
        .message-outgoing {
            max-width: 85%;
            margin-bottom: 16px;
            padding: 12px 16px;
            border-radius: 20px;
            font-size: 15px;
            line-height: 1.4;
            word-wrap: break-word;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .message-incoming {
            background-color: #ffffff;
            align-self: flex-start;
            color: #333;
        }

        .message-outgoing {
            background-color: #e3d1f3;
            align-self: flex-end;
            color: #4a0072;
        }

        .timestamp {
            font-size: 12px;
            color: #888;
            margin-top: 6px;
            text-align: right;
        }

        .predefined-options {
            margin-top: 12px;
            padding: 12px 0;
            border-top: 1px solid #ddd;
        }

        .predefined-options .option-btn {
            font-size: 14px;
            padding: 6px 12px;
            border-radius: 20px;
        }

        .typing-indicator {
            padding: 12px;
            display: flex;
            justify-content: flex-start;
        }

        .typing-dots span {
            display: inline-block;
            width: 8px;
            height: 8px;
            margin: 0 3px;
            background-color: #999;
            border-radius: 50%;
            animation: typing 1.2s infinite;
        }

        .typing-dots span:nth-child(2) {
            animation-delay: 0.2s;
        }

        .typing-dots span:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes typing {
            0% {
                transform: scale(1);
                opacity: 0.3;
            }

            50% {
                transform: scale(1.5);
                opacity: 1;
            }

            100% {
                transform: scale(1);
                opacity: 0.3;
            }
        }
    </style>


</head>

<body>
    <!-- Chat Toggle Button -->
    <button class="chatbot-btn chat-trigger" id="chatToggleBtn" style="z-index: 2000;">
        <span style="margin-right: 8px;">💬</span> Ask Question
    </button>

    <!-- Fixed Chatbot Widget -->
    <div class="chat-widget" id="chatWidget">
        <div class="chat-content">
            <div class="chat-header top-0 w-100 d-flex align-items-center justify-content-between px-3 py-2"
                style="backdrop-filter: blur(10px); background-color: rgba(255,255,255,0.4); border-bottom: 1px solid rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 10;">
                <div class="d-flex align-items-center gap-2">
                    <img src="<?php echo base_url('assets/Images/chatboticon.svg'); ?>" alt="Chatbot"
                        style="width: 2.5rem;">
                    <h5 class="mb-0 fw-semibold text-dark" style="font-size:28px !important">Sitara</h5>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button class="close-btn" id="chatCloseBtn"
                        style="background: none; border: none; font-size: 24px; color: #6C3B9B;">&times;</button>
                </div>
            </div>

            <div class="chat-welcome p-3">
                <div class="predefined-options mt-3 d-flex flex-wrap gap-2">
                    <button class="btn btn-outline-secondary option-btn" onclick="handleQuickOption('Hey')">Hey</button>
                    <button class="btn btn-outline-secondary option-btn"
                        onclick="handleQuickOption('How can you help me?')">How can you help me?</button>
                    <button class="btn btn-outline-secondary option-btn"
                        onclick="handleQuickOption('Tell me a joke')">Tell me a joke</button>
                    <button class="btn btn-outline-secondary option-btn"
                        onclick="handleQuickOption('I want to know about astrogems')">I want to know about
                        astrogems</button>
                </div>
            </div>
            <div class="chat-body" id="chatBody">
                <div class="typing-indicator" id="typingIndicator" style="display:none;">
                    <div class="typing-dots">
                        <span></span><span></span><span></span>
                    </div>
                </div>
            </div>
            <!-- Footer Removed -->
        </div>
    </div>

    <script>

        const chatToggleBtn = document.getElementById('chatToggleBtn');
        const chatWidget = document.getElementById('chatWidget');
        const chatCloseBtn = document.getElementById('chatCloseBtn');
        const chatBody = document.getElementById('chatBody');
        const typingIndicator = document.getElementById('typingIndicator');

        let isChatOpen = false;

        function toggleChat() {
            isChatOpen = !isChatOpen;
            chatWidget.style.display = isChatOpen ? 'block' : 'none';
            if (isChatOpen) {
                chatToggleBtn.style.display = 'none';
                scrollToBottom();
                showInitialOptions();
            }
        }

        chatToggleBtn.addEventListener('click', toggleChat);
        chatCloseBtn.addEventListener('click', () => {
            toggleChat();
            chatToggleBtn.style.display = 'block';
        });

        function scrollToBottom() {
            chatBody.scrollTop = chatBody.scrollHeight;
        }

        function getCurrentTime() {
            const now = new Date();
            return now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        }

        function createMessage(text, isOutgoing = false) {
            const messageDiv = document.createElement('div');
            messageDiv.className = isOutgoing ? 'message-outgoing' : 'message-incoming';
            messageDiv.innerHTML = `
            ${text}
            <div class="timestamp">Today ${getCurrentTime()}</div>
        `;
            return messageDiv;
        }

        function addMessage(text, isOutgoing = false) {
            const messageElement = createMessage(text, isOutgoing);
            chatBody.insertBefore(messageElement, typingIndicator);
            scrollToBottom();
        }

        function showTyping() {
            typingIndicator.style.display = 'block';
            scrollToBottom();
        }

        function hideTyping() {
            typingIndicator.style.display = 'none';
        }

        function clearOptions() {
            const oldOptions = document.querySelector('.predefined-options');
            if (oldOptions) oldOptions.remove();
        }

        function renderOptions(options) {
            const newOptions = document.createElement('div');
            newOptions.className = 'predefined-options mt-3 mx-3 my-3 d-flex flex-wrap gap-2';
            newOptions.innerHTML = options.map(option => `
            <button class="btn btn-outline-secondary option-btn " onclick="handleQuickOption('${option.key}')">${option.label}</button>
        `).join('');
            chatBody.insertBefore(newOptions, typingIndicator);
            scrollToBottom();
        }

        const chatTree = {
            start: {
                message: "Hi! I'm your Astro Assistant. What would you like to talk about?",
                options: [
                    { key: 'hey', label: 'Hey 👋' },
                    { key: 'help', label: 'How can you help me?' },
                    { key: 'joke', label: 'Tell me a joke' },
                    { key: 'astrogems', label: 'I want to know about astrogems' }]
            },
            hey: {
                message: "Hey there! Nice to see you. What are you curious about?",
                options: [
                    { key: 'services', label: 'Your services?' },
                    { key: 'luckyStone', label: 'Suggest lucky stone' },
                    { key: 'astrogems', label: 'Tell me about astrogems' }
                ]
            },
            help: {
                message: "Sure! I can assist you with:\n- Lucky stones\n- Astrogem recommendations\n- Current schemes\nWhat would you like?",
                options: [
                    { key: 'luckyStone', label: 'Suggest lucky stone' },
                    { key: 'scheme', label: 'Tell me about schemes' },
                    { key: 'astrogems', label: 'Astrogem info' }
                ]
            },
            joke: {
                message: "Why don't scientists trust atoms?\nBecause they make up everything! 😄",
                options: [
                    { key: 'anotherJoke', label: 'Tell me another joke' },
                    { key: 'start', label: 'Back to Start' }
                ]
            },
            anotherJoke: {
                message: "Why did the sun go to school?\nTo get a little brighter! ☀️😄",
                options: [
                    { key: 'start', label: 'Back to Start' }
                ]
            },
            astrogems: {
                message: "Astrogems are special stones believed to influence your destiny. Do you want recommendations?",
                options: [
                    { key: 'recommend', label: 'Yes, recommend one' },
                    { key: 'start', label: 'Back to Start' }
                ]
            },
            recommend: {
                message: "Please share your zodiac sign, and I’ll suggest the best gem for you.",
                options: [
                    { key: 'aries', label: 'I’m Aries ♈' },
                    { key: 'taurus', label: 'I’m Taurus ♉' },
                    { key: 'start', label: 'Back to Start' }
                ]

            },
            aries: {
                message: "Great! For Aries, the best gem is Red Coral. It boosts energy and leadership.",
                options: [
                    { key: 'start', label: 'Back to Start' }
                ]
            },
            taurus: {
                message: "Awesome! For Taurus, Emerald works wonders. It brings clarity and prosperity.",
                options: [
                    { key: 'start', label: 'Back to Start' }
                ]
            },
            services: {
                message: "We offer consultations, gem suggestions, horoscope readings, and more.",
                options: [
                    { key: 'start', label: 'Back to Start' }
                ]
            },
            luckyStone: {
                message: "Tell me your birth month and zodiac, and I’ll suggest a stone.",
                options: [
                    { key: 'recommend', label: 'Go to Recommendation' },
                    { key: 'start', label: 'Back to Start' }
                ]
            },
            scheme: {
                message: "We have special schemes like 11+1 and 10+2 where you get bonus months free!",
                options: [
                    { key: 'start', label: 'Back to Start' }
                ]
            }
        };

        function handleQuickOption(key) {
            clearOptions();
            addMessage(key, true);
            showTyping();

            setTimeout(() => {
                hideTyping();
                const node = chatTree[key];
                if (node) {
                    addMessage(node.message, false);
                    if (node.options) {
                        renderOptions(node.options);
                    }
                } else {
                    addMessage("Oops! I didn’t understand that. Try another option.", false);
                    renderOptions(chatTree.start.options);
                }
            }, 1000 + Math.random() * 500);
        }

        function showInitialOptions() {
            clearOptions();
            const startNode = chatTree.start;
            addMessage(startNode.message, false);
            renderOptions(startNode.options);
        }

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