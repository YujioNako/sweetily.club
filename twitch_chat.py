import socket
import re
import requests
import json
import datetime


def parse_chat_message(message):
    # 解析聊天消息，提取用户名和消息内容
    pattern = re.compile(r'^:([^!]+)![^@]+@[^\.]+\.tmi\.twitch\.tv PRIVMSG #[^ ]+ :(.+)$')
    match = pattern.match(message)
    if match:
        username = match.group(1)
        content = match.group(2)
        return username, content
    return None, None

def connect_to_chat(username, token, channel):
    server = 'irc.chat.twitch.tv'
    port = 6667

    # 创建TCP套接字并连接到Twitch IRC服务器
    irc_socket = socket.socket()
    irc_socket.connect((server, port))

    # 发送身份验证和加入聊天室的命令
    irc_socket.send(f"PASS {token}\n".encode('utf-8'))
    irc_socket.send(f"NICK {username}\n".encode('utf-8'))
    irc_socket.send(f"JOIN #{channel}\n".encode('utf-8'))
    
    print('connected')

    return irc_socket

def read_chat_messages(irc_socket):
    while True:
        # 从套接字中读取聊天消息
        message = irc_socket.recv(2048).decode('utf-8')
        print(message)
        if message.startswith('PING'):
            # 如果收到PING消息，则回应PONG以保持连接
            irc_socket.send('PONG\n'.encode('utf-8'))
        else:
            # 解析聊天消息并返回用户名和消息内容
            username, content = parse_chat_message(message)
            if username and content:
                print(username, content)
                yield username, content

def write_json(data, file):
    # 读取文件内容
    with open(file, 'r') as f:
        file_data = json.load(f)

    # 将数据添加到文件内容
    file_data.append(data)

    # 将更新后的内容写回文件
    with open(file, 'w') as f:
        json.dump(file_data, f)

# 设置你的Client ID和Client Secret
client_id = 'xrunsfzqxqqpo91ind4ptsvayxbs3j'
client_secret = 'wm40par0pj52jqhby6edzrnux5w3am'

# 获取访问令牌（App Access Token）
auth_url = 'https://id.twitch.tv/oauth2/token'
auth_params = {
    'client_id': client_id,
    'client_secret': client_secret,
    'grant_type': 'client_credentials'
}
auth_response = requests.post(auth_url, params=auth_params)
auth_data = auth_response.json()
access_token = auth_data['access_token']

# 设置你的Twitch账号的用户名和OAuth令牌
username = 'yujionako'
token = access_token

# 设置要抓取聊天内容的直播频道
channel = 'sweetily'

# 连接到Twitch聊天室
irc_socket = connect_to_chat(username, token, channel)

# 创建一个空字典来存储聊天内容
with open('chat_data.json', 'r') as f:
        chat_data = json.load(f)

# 读取聊天消息并保存到字典中
for username, content in read_chat_messages(irc_socket):
    # 获取当前日期
    current_date = datetime.date.today().isoformat()

    # 创建一个新的日期条目，如果不存在的话
    if current_date not in chat_data:
        chat_data[current_date] = []

    # 构建聊天消息对象
    chat_message = {
        'time': datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S"),
        'name': username,
        'content': content
    }
    
    if chat_message not in chat_data[current_date]:
    
        # 将聊天消息添加到当前日期的条目中
        chat_data[current_date].append(chat_message)
    
        # 将聊天数据保存到JSON文件中
        write_json('chat_data.json', chat_data)
