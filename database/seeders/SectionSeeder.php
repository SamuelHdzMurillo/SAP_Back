<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\District;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = '[
            
                {
                    "distrito_local": 2,
                    "seccion": 177
                },
                {
                    "distrito_local": 2,
                    "seccion": 162
                },
                {
                    "distrito_local": 2,
                    "seccion": 163
                },
                {
                    "distrito_local": 2,
                    "seccion": 164
                },
                {
                    "distrito_local": 2,
                    "seccion": 165
                },
                {
                    "distrito_local": 2,
                    "seccion": 166
                },
                {
                    "distrito_local": 2,
                    "seccion": 167
                },
                {
                    "distrito_local": 2,
                    "seccion": 169
                },
                {
                    "distrito_local": 2,
                    "seccion": 171
                },
                {
                    "distrito_local": 2,
                    "seccion": 172
                },
                {
                    "distrito_local": 2,
                    "seccion": 173
                },
                {
                    "distrito_local": 2,
                    "seccion": 174
                },
                {
                    "distrito_local": 2,
                    "seccion": 161
                },
                {
                    "distrito_local": 2,
                    "seccion": 176
                },
                {
                    "distrito_local": 2,
                    "seccion": 168
                },
                {
                    "distrito_local": 2,
                    "seccion": 178
                },
                {
                    "distrito_local": 2,
                    "seccion": 179
                },
                {
                    "distrito_local": 2,
                    "seccion": 180
                },
                {
                    "distrito_local": 2,
                    "seccion": 188
                },
                {
                    "distrito_local": 2,
                    "seccion": 193
                },
                {
                    "distrito_local": 2,
                    "seccion": 195
                },
                {
                    "distrito_local": 2,
                    "seccion": 196
                },
                {
                    "distrito_local": 2,
                    "seccion": 198
                },
                {
                    "distrito_local": 2,
                    "seccion": 199
                },
                {
                    "distrito_local": 2,
                    "seccion": 200
                },
                {
                    "distrito_local": 2,
                    "seccion": 201
                },
                {
                    "distrito_local": 2,
                    "seccion": 122
                },
                {
                    "distrito_local": 2,
                    "seccion": 175
                },
                {
                    "distrito_local": 2,
                    "seccion": 135
                },
                {
                    "distrito_local": 2,
                    "seccion": 123
                },
                {
                    "distrito_local": 2,
                    "seccion": 124
                },
                {
                    "distrito_local": 2,
                    "seccion": 125
                },
                {
                    "distrito_local": 2,
                    "seccion": 126
                },
                {
                    "distrito_local": 2,
                    "seccion": 127
                },
                {
                    "distrito_local": 2,
                    "seccion": 170
                },
                {
                    "distrito_local": 2,
                    "seccion": 129
                },
                {
                    "distrito_local": 2,
                    "seccion": 160
                },
                {
                    "distrito_local": 2,
                    "seccion": 136
                },
                {
                    "distrito_local": 2,
                    "seccion": 137
                },
                {
                    "distrito_local": 2,
                    "seccion": 138
                },
                {
                    "distrito_local": 2,
                    "seccion": 139
                },
                {
                    "distrito_local": 2,
                    "seccion": 140
                },
                {
                    "distrito_local": 2,
                    "seccion": 141
                },
                {
                    "distrito_local": 2,
                    "seccion": 151
                },
                {
                    "distrito_local": 2,
                    "seccion": 128
                },
                {
                    "distrito_local": 2,
                    "seccion": 142
                },
                {
                    "distrito_local": 2,
                    "seccion": 159
                },
                {
                    "distrito_local": 2,
                    "seccion": 155
                },
                {
                    "distrito_local": 2,
                    "seccion": 152
                },
                {
                    "distrito_local": 2,
                    "seccion": 150
                },
                {
                    "distrito_local": 2,
                    "seccion": 149
                },
                {
                    "distrito_local": 2,
                    "seccion": 148
                },
                {
                    "distrito_local": 2,
                    "seccion": 147
                },
                {
                    "distrito_local": 2,
                    "seccion": 146
                },
                {
                    "distrito_local": 2,
                    "seccion": 145
                },
                {
                    "distrito_local": 2,
                    "seccion": 144
                },
                {
                    "distrito_local": 2,
                    "seccion": 154
                },
                {
                    "distrito_local": 3,
                    "seccion": 461
                },
                {
                    "distrito_local": 3,
                    "seccion": 480
                },
                {
                    "distrito_local": 3,
                    "seccion": 460
                },
                {
                    "distrito_local": 3,
                    "seccion": 467
                },
                {
                    "distrito_local": 3,
                    "seccion": 462
                },
                {
                    "distrito_local": 3,
                    "seccion": 463
                },
                {
                    "distrito_local": 3,
                    "seccion": 464
                },
                {
                    "distrito_local": 3,
                    "seccion": 465
                },
                {
                    "distrito_local": 3,
                    "seccion": 466
                },
                {
                    "distrito_local": 3,
                    "seccion": 468
                },
                {
                    "distrito_local": 3,
                    "seccion": 469
                },
                {
                    "distrito_local": 3,
                    "seccion": 470
                },
                {
                    "distrito_local": 3,
                    "seccion": 471
                },
                {
                    "distrito_local": 3,
                    "seccion": 472
                },
                {
                    "distrito_local": 3,
                    "seccion": 474
                },
                {
                    "distrito_local": 3,
                    "seccion": 448
                },
                {
                    "distrito_local": 3,
                    "seccion": 459
                },
                {
                    "distrito_local": 3,
                    "seccion": 473
                },
                {
                    "distrito_local": 3,
                    "seccion": 445
                },
                {
                    "distrito_local": 3,
                    "seccion": 458
                },
                {
                    "distrito_local": 3,
                    "seccion": 442
                },
                {
                    "distrito_local": 3,
                    "seccion": 450
                },
                {
                    "distrito_local": 3,
                    "seccion": 444
                },
                {
                    "distrito_local": 3,
                    "seccion": 446
                },
                {
                    "distrito_local": 3,
                    "seccion": 447
                },
                {
                    "distrito_local": 3,
                    "seccion": 449
                },
                {
                    "distrito_local": 3,
                    "seccion": 451
                },
                {
                    "distrito_local": 3,
                    "seccion": 457
                },
                {
                    "distrito_local": 3,
                    "seccion": 452
                },
                {
                    "distrito_local": 3,
                    "seccion": 453
                },
                {
                    "distrito_local": 3,
                    "seccion": 454
                },
                {
                    "distrito_local": 3,
                    "seccion": 455
                },
                {
                    "distrito_local": 3,
                    "seccion": 456
                },
                {
                    "distrito_local": 3,
                    "seccion": 441
                },
                {
                    "distrito_local": 3,
                    "seccion": 443
                },
                {
                    "distrito_local": 4,
                    "seccion": 492
                },
                {
                    "distrito_local": 4,
                    "seccion": 483
                },
                {
                    "distrito_local": 4,
                    "seccion": 484
                },
                {
                    "distrito_local": 4,
                    "seccion": 485
                },
                {
                    "distrito_local": 4,
                    "seccion": 486
                },
                {
                    "distrito_local": 4,
                    "seccion": 487
                },
                {
                    "distrito_local": 4,
                    "seccion": 488
                },
                {
                    "distrito_local": 4,
                    "seccion": 491
                },
                {
                    "distrito_local": 4,
                    "seccion": 479
                },
                {
                    "distrito_local": 4,
                    "seccion": 495
                },
                {
                    "distrito_local": 4,
                    "seccion": 489
                },
                {
                    "distrito_local": 4,
                    "seccion": 182
                },
                {
                    "distrito_local": 4,
                    "seccion": 482
                },
                {
                    "distrito_local": 4,
                    "seccion": 481
                },
                {
                    "distrito_local": 4,
                    "seccion": 181
                },
                {
                    "distrito_local": 4,
                    "seccion": 183
                },
                {
                    "distrito_local": 4,
                    "seccion": 203
                },
                {
                    "distrito_local": 4,
                    "seccion": 204
                },
                {
                    "distrito_local": 4,
                    "seccion": 205
                },
                {
                    "distrito_local": 4,
                    "seccion": 206
                },
                {
                    "distrito_local": 4,
                    "seccion": 249
                },
                {
                    "distrito_local": 4,
                    "seccion": 478
                },
                {
                    "distrito_local": 5,
                    "seccion": 494
                },
                {
                    "distrito_local": 5,
                    "seccion": 350
                },
                {
                    "distrito_local": 5,
                    "seccion": 266
                },
                {
                    "distrito_local": 5,
                    "seccion": 288
                },
                {
                    "distrito_local": 5,
                    "seccion": 289
                },
                {
                    "distrito_local": 5,
                    "seccion": 348
                },
                {
                    "distrito_local": 5,
                    "seccion": 349
                },
                {
                    "distrito_local": 5,
                    "seccion": 265
                },
                {
                    "distrito_local": 5,
                    "seccion": 440
                },
                {
                    "distrito_local": 5,
                    "seccion": 475
                },
                {
                    "distrito_local": 5,
                    "seccion": 476
                },
                {
                    "distrito_local": 5,
                    "seccion": 477
                },
                {
                    "distrito_local": 5,
                    "seccion": 493
                },
                {
                    "distrito_local": 5,
                    "seccion": 264
                },
                {
                    "distrito_local": 5,
                    "seccion": 261
                },
                {
                    "distrito_local": 5,
                    "seccion": 490
                },
                {
                    "distrito_local": 5,
                    "seccion": 186
                },
                {
                    "distrito_local": 5,
                    "seccion": 185
                },
                {
                    "distrito_local": 5,
                    "seccion": 187
                },
                {
                    "distrito_local": 5,
                    "seccion": 189
                },
                {
                    "distrito_local": 5,
                    "seccion": 207
                },
                {
                    "distrito_local": 5,
                    "seccion": 208
                },
                {
                    "distrito_local": 5,
                    "seccion": 209
                },
                {
                    "distrito_local": 5,
                    "seccion": 210
                },
                {
                    "distrito_local": 5,
                    "seccion": 184
                },
                {
                    "distrito_local": 5,
                    "seccion": 256
                },
                {
                    "distrito_local": 5,
                    "seccion": 257
                },
                {
                    "distrito_local": 5,
                    "seccion": 258
                },
                {
                    "distrito_local": 5,
                    "seccion": 259
                },
                {
                    "distrito_local": 5,
                    "seccion": 260
                },
                {
                    "distrito_local": 5,
                    "seccion": 263
                },
                {
                    "distrito_local": 5,
                    "seccion": 262
                },
                {
                    "distrito_local": 5,
                    "seccion": 218
                },
                {
                    "distrito_local": 6,
                    "seccion": 278
                },
                {
                    "distrito_local": 6,
                    "seccion": 277
                },
                {
                    "distrito_local": 6,
                    "seccion": 276
                },
                {
                    "distrito_local": 6,
                    "seccion": 279
                },
                {
                    "distrito_local": 6,
                    "seccion": 271
                },
                {
                    "distrito_local": 6,
                    "seccion": 286
                },
                {
                    "distrito_local": 6,
                    "seccion": 273
                },
                {
                    "distrito_local": 6,
                    "seccion": 280
                },
                {
                    "distrito_local": 6,
                    "seccion": 281
                },
                {
                    "distrito_local": 6,
                    "seccion": 282
                },
                {
                    "distrito_local": 6,
                    "seccion": 284
                },
                {
                    "distrito_local": 6,
                    "seccion": 287
                },
                {
                    "distrito_local": 6,
                    "seccion": 270
                },
                {
                    "distrito_local": 6,
                    "seccion": 272
                },
                {
                    "distrito_local": 6,
                    "seccion": 283
                },
                {
                    "distrito_local": 6,
                    "seccion": 133
                },
                {
                    "distrito_local": 6,
                    "seccion": 121
                },
                {
                    "distrito_local": 6,
                    "seccion": 274
                },
                {
                    "distrito_local": 6,
                    "seccion": 269
                },
                {
                    "distrito_local": 6,
                    "seccion": 130
                },
                {
                    "distrito_local": 6,
                    "seccion": 132
                },
                {
                    "distrito_local": 6,
                    "seccion": 134
                },
                {
                    "distrito_local": 6,
                    "seccion": 143
                },
                {
                    "distrito_local": 6,
                    "seccion": 153
                },
                {
                    "distrito_local": 6,
                    "seccion": 157
                },
                {
                    "distrito_local": 6,
                    "seccion": 158
                },
                {
                    "distrito_local": 6,
                    "seccion": 254
                },
                {
                    "distrito_local": 6,
                    "seccion": 255
                },
                {
                    "distrito_local": 6,
                    "seccion": 156
                },
                {
                    "distrito_local": 6,
                    "seccion": 268
                },
                {
                    "distrito_local": 6,
                    "seccion": 131
                },
                {
                    "distrito_local": 6,
                    "seccion": 267
                },
                {
                    "distrito_local": 10,
                    "seccion": 30
                },
                {
                    "distrito_local": 10,
                    "seccion": 37
                },
                {
                    "distrito_local": 10,
                    "seccion": 36
                },
                {
                    "distrito_local": 10,
                    "seccion": 33
                },
                {
                    "distrito_local": 10,
                    "seccion": 32
                },
                {
                    "distrito_local": 10,
                    "seccion": 74
                },
                {
                    "distrito_local": 10,
                    "seccion": 31
                },
                {
                    "distrito_local": 10,
                    "seccion": 38
                },
                {
                    "distrito_local": 10,
                    "seccion": 29
                },
                {
                    "distrito_local": 10,
                    "seccion": 50
                },
                {
                    "distrito_local": 10,
                    "seccion": 28
                },
                {
                    "distrito_local": 10,
                    "seccion": 39
                },
                {
                    "distrito_local": 10,
                    "seccion": 41
                },
                {
                    "distrito_local": 10,
                    "seccion": 42
                },
                {
                    "distrito_local": 10,
                    "seccion": 43
                },
                {
                    "distrito_local": 10,
                    "seccion": 44
                },
                {
                    "distrito_local": 10,
                    "seccion": 45
                },
                {
                    "distrito_local": 10,
                    "seccion": 49
                },
                {
                    "distrito_local": 10,
                    "seccion": 51
                },
                {
                    "distrito_local": 10,
                    "seccion": 53
                },
                {
                    "distrito_local": 10,
                    "seccion": 27
                },
                {
                    "distrito_local": 10,
                    "seccion": 19
                },
                {
                    "distrito_local": 10,
                    "seccion": 47
                },
                {
                    "distrito_local": 10,
                    "seccion": 3
                },
                {
                    "distrito_local": 10,
                    "seccion": 21
                },
                {
                    "distrito_local": 10,
                    "seccion": 26
                },
                {
                    "distrito_local": 10,
                    "seccion": 1
                },
                {
                    "distrito_local": 10,
                    "seccion": 5
                },
                {
                    "distrito_local": 10,
                    "seccion": 6
                },
                {
                    "distrito_local": 10,
                    "seccion": 7
                },
                {
                    "distrito_local": 10,
                    "seccion": 8
                },
                {
                    "distrito_local": 10,
                    "seccion": 9
                },
                {
                    "distrito_local": 10,
                    "seccion": 10
                },
                {
                    "distrito_local": 10,
                    "seccion": 11
                },
                {
                    "distrito_local": 10,
                    "seccion": 23
                },
                {
                    "distrito_local": 10,
                    "seccion": 14
                },
                {
                    "distrito_local": 10,
                    "seccion": 15
                },
                {
                    "distrito_local": 10,
                    "seccion": 16
                },
                {
                    "distrito_local": 10,
                    "seccion": 17
                },
                {
                    "distrito_local": 10,
                    "seccion": 18
                },
                {
                    "distrito_local": 10,
                    "seccion": 20
                },
                {
                    "distrito_local": 10,
                    "seccion": 22
                },
                {
                    "distrito_local": 10,
                    "seccion": 24
                },
                {
                    "distrito_local": 10,
                    "seccion": 25
                },
                {
                    "distrito_local": 10,
                    "seccion": 12
                },
                
                {
                    "distrito_local": 13,
                    "seccion": 496
                },
                {
                    "distrito_local": 14,
                    "seccion": 116
                },
                {
                    "distrito_local": 14,
                    "seccion": 115
                },
                {
                    "distrito_local": 14,
                    "seccion": 114
                },
                {
                    "distrito_local": 14,
                    "seccion": 112
                },
                {
                    "distrito_local": 14,
                    "seccion": 110
                },
                {
                    "distrito_local": 14,
                    "seccion": 108
                },
                {
                    "distrito_local": 14,
                    "seccion": 117
                },
                {
                    "distrito_local": 14,
                    "seccion": 502
                },
                {
                    "distrito_local": 14,
                    "seccion": 109
                },
                {
                    "distrito_local": 14,
                    "seccion": 119
                },
                {
                    "distrito_local": 14,
                    "seccion": 120
                },
                {
                    "distrito_local": 14,
                    "seccion": 497
                },
                {
                    "distrito_local": 14,
                    "seccion": 498
                },
                {
                    "distrito_local": 14,
                    "seccion": 499
                },
                {
                    "distrito_local": 14,
                    "seccion": 107
                },
                {
                    "distrito_local": 14,
                    "seccion": 501
                },
                {
                    "distrito_local": 14,
                    "seccion": 111
                },
                {
                    "distrito_local": 14,
                    "seccion": 500
                },
                {
                    "distrito_local": 14,
                    "seccion": 81
                },
                {
                    "distrito_local": 14,
                    "seccion": 113
                },
                {
                    "distrito_local": 14,
                    "seccion": 105
                },
                {
                    "distrito_local": 14,
                    "seccion": 76
                },
                {
                    "distrito_local": 14,
                    "seccion": 77
                },
                {
                    "distrito_local": 14,
                    "seccion": 78
                },
                {
                    "distrito_local": 14,
                    "seccion": 80
                },
                {
                    "distrito_local": 14,
                    "seccion": 75
                },
                {
                    "distrito_local": 14,
                    "seccion": 92
                },
                {
                    "distrito_local": 14,
                    "seccion": 93
                },
                {
                    "distrito_local": 14,
                    "seccion": 94
                },
                {
                    "distrito_local": 14,
                    "seccion": 102
                },
                {
                    "distrito_local": 14,
                    "seccion": 79
                },
                {
                    "distrito_local": 14,
                    "seccion": 103
                },
                {
                    "distrito_local": 14,
                    "seccion": 95
                },
                {
                    "distrito_local": 14,
                    "seccion": 101
                },
                {
                    "distrito_local": 14,
                    "seccion": 99
                },
                {
                    "distrito_local": 14,
                    "seccion": 98
                },
                {
                    "distrito_local": 14,
                    "seccion": 97
                },
                {
                    "distrito_local": 14,
                    "seccion": 96
                },
                {
                    "distrito_local": 15,
                    "seccion": 230
                },
                {
                    "distrito_local": 15,
                    "seccion": 240
                },
                {
                    "distrito_local": 15,
                    "seccion": 231
                },
                {
                    "distrito_local": 15,
                    "seccion": 233
                },
                {
                    "distrito_local": 15,
                    "seccion": 234
                },
                {
                    "distrito_local": 15,
                    "seccion": 235
                },
                {
                    "distrito_local": 15,
                    "seccion": 236
                },
                {
                    "distrito_local": 15,
                    "seccion": 237
                },
                {
                    "distrito_local": 15,
                    "seccion": 238
                },
                {
                    "distrito_local": 15,
                    "seccion": 239
                },
                {
                    "distrito_local": 15,
                    "seccion": 232
                },
                {
                    "distrito_local": 15,
                    "seccion": 241
                },
                {
                    "distrito_local": 15,
                    "seccion": 242
                },
                {
                    "distrito_local": 15,
                    "seccion": 243
                },
                {
                    "distrito_local": 15,
                    "seccion": 244
                },
                {
                    "distrito_local": 15,
                    "seccion": 245
                },
                {
                    "distrito_local": 15,
                    "seccion": 246
                },
                {
                    "distrito_local": 15,
                    "seccion": 247
                },
                {
                    "distrito_local": 15,
                    "seccion": 248
                },
                {
                    "distrito_local": 15,
                    "seccion": 251
                },
                {
                    "distrito_local": 15,
                    "seccion": 229
                },
                {
                    "distrito_local": 15,
                    "seccion": 222
                },
                {
                    "distrito_local": 15,
                    "seccion": 250
                },
                {
                    "distrito_local": 15,
                    "seccion": 211
                },
                {
                    "distrito_local": 15,
                    "seccion": 224
                },
                {
                    "distrito_local": 15,
                    "seccion": 228
                },
                {
                    "distrito_local": 15,
                    "seccion": 191
                },
                {
                    "distrito_local": 15,
                    "seccion": 192
                },
                {
                    "distrito_local": 15,
                    "seccion": 194
                },
                {
                    "distrito_local": 15,
                    "seccion": 202
                },
                {
                    "distrito_local": 15,
                    "seccion": 212
                },
                {
                    "distrito_local": 15,
                    "seccion": 213
                },
                {
                    "distrito_local": 15,
                    "seccion": 214
                },
                {
                    "distrito_local": 15,
                    "seccion": 215
                },
                {
                    "distrito_local": 15,
                    "seccion": 223
                },
                {
                    "distrito_local": 15,
                    "seccion": 197
                },
                {
                    "distrito_local": 15,
                    "seccion": 226
                },
                {
                    "distrito_local": 15,
                    "seccion": 216
                },
                {
                    "distrito_local": 15,
                    "seccion": 225
                },
                {
                    "distrito_local": 15,
                    "seccion": 190
                },
                {
                    "distrito_local": 15,
                    "seccion": 227
                },
                {
                    "distrito_local": 15,
                    "seccion": 221
                },
                {
                    "distrito_local": 15,
                    "seccion": 220
                },
                {
                    "distrito_local": 15,
                    "seccion": 219
                },
                {
                    "distrito_local": 15,
                    "seccion": 217
                },
                {
                    "distrito_local": 1,
                    "seccion": 514
                },
                {
                    "distrito_local": 1,
                    "seccion": 505
                },
                {
                    "distrito_local": 1,
                    "seccion": 508
                },
                {
                    "distrito_local": 1,
                    "seccion": 507
                },
                {
                    "distrito_local": 1,
                    "seccion": 506
                },
                {
                    "distrito_local": 1,
                    "seccion": 509
                },
                {
                    "distrito_local": 1,
                    "seccion": 510
                },
                {
                    "distrito_local": 1,
                    "seccion": 511
                },
                {
                    "distrito_local": 1,
                    "seccion": 513
                },
                {
                    "distrito_local": 1,
                    "seccion": 504
                },
                {
                    "distrito_local": 1,
                    "seccion": 515
                },
                {
                    "distrito_local": 1,
                    "seccion": 299
                },
                {
                    "distrito_local": 1,
                    "seccion": 512
                },
                {
                    "distrito_local": 1,
                    "seccion": 292
                },
                {
                    "distrito_local": 1,
                    "seccion": 302
                },
                {
                    "distrito_local": 1,
                    "seccion": 503
                },
                {
                    "distrito_local": 1,
                    "seccion": 291
                },
                {
                    "distrito_local": 1,
                    "seccion": 293
                },
                {
                    "distrito_local": 1,
                    "seccion": 294
                },
                {
                    "distrito_local": 1,
                    "seccion": 295
                },
                {
                    "distrito_local": 1,
                    "seccion": 296
                },
                {
                    "distrito_local": 1,
                    "seccion": 297
                },
                {
                    "distrito_local": 1,
                    "seccion": 300
                },
                {
                    "distrito_local": 1,
                    "seccion": 315
                },
                {
                    "distrito_local": 1,
                    "seccion": 431
                },
                {
                    "distrito_local": 1,
                    "seccion": 290
                },
                {
                    "distrito_local": 7,
                    "seccion": 419
                },
                {
                    "distrito_local": 7,
                    "seccion": 432
                },
                {
                    "distrito_local": 7,
                    "seccion": 427
                },
                {
                    "distrito_local": 7,
                    "seccion": 428
                },
                {
                    "distrito_local": 7,
                    "seccion": 429
                },
                {
                    "distrito_local": 7,
                    "seccion": 426
                },
                {
                    "distrito_local": 7,
                    "seccion": 430
                },
                {
                    "distrito_local": 7,
                    "seccion": 433
                },
                {
                    "distrito_local": 7,
                    "seccion": 434
                },
                {
                    "distrito_local": 7,
                    "seccion": 435
                },
                {
                    "distrito_local": 7,
                    "seccion": 436
                },
                {
                    "distrito_local": 7,
                    "seccion": 437
                },
                {
                    "distrito_local": 7,
                    "seccion": 439
                },
                {
                    "distrito_local": 7,
                    "seccion": 438
                },
                {
                    "distrito_local": 7,
                    "seccion": 414
                },
                {
                    "distrito_local": 7,
                    "seccion": 425
                },
                {
                    "distrito_local": 7,
                    "seccion": 413
                },
                {
                    "distrito_local": 7,
                    "seccion": 415
                },
                {
                    "distrito_local": 7,
                    "seccion": 416
                },
                {
                    "distrito_local": 7,
                    "seccion": 417
                },
                {
                    "distrito_local": 7,
                    "seccion": 424
                },
                {
                    "distrito_local": 7,
                    "seccion": 421
                },
                {
                    "distrito_local": 7,
                    "seccion": 420
                },
                {
                    "distrito_local": 7,
                    "seccion": 422
                },
                {
                    "distrito_local": 7,
                    "seccion": 423
                },
                {
                    "distrito_local": 7,
                    "seccion": 418
                },
                {
                    "distrito_local": 7,
                    "seccion": 412
                },
                {
                    "distrito_local": 8,
                    "seccion": 374
                },
                {
                    "distrito_local": 8,
                    "seccion": 405
                },
                {
                    "distrito_local": 8,
                    "seccion": 406
                },
                {
                    "distrito_local": 8,
                    "seccion": 407
                },
                {
                    "distrito_local": 8,
                    "seccion": 408
                },
                {
                    "distrito_local": 8,
                    "seccion": 410
                },
                {
                    "distrito_local": 8,
                    "seccion": 366
                },
                {
                    "distrito_local": 8,
                    "seccion": 363
                },
                {
                    "distrito_local": 8,
                    "seccion": 409
                },
                {
                    "distrito_local": 8,
                    "seccion": 356
                },
                {
                    "distrito_local": 8,
                    "seccion": 364
                },
                {
                    "distrito_local": 8,
                    "seccion": 362
                },
                {
                    "distrito_local": 8,
                    "seccion": 361
                },
                {
                    "distrito_local": 8,
                    "seccion": 360
                },
                {
                    "distrito_local": 8,
                    "seccion": 359
                },
                {
                    "distrito_local": 8,
                    "seccion": 358
                },
                {
                    "distrito_local": 8,
                    "seccion": 357
                },
                {
                    "distrito_local": 8,
                    "seccion": 365
                },
                {
                    "distrito_local": 9,
                    "seccion": 389
                },
                {
                    "distrito_local": 9,
                    "seccion": 390
                },
                {
                    "distrito_local": 9,
                    "seccion": 391
                },
                {
                    "distrito_local": 9,
                    "seccion": 392
                },
                {
                    "distrito_local": 9,
                    "seccion": 393
                },
                {
                    "distrito_local": 9,
                    "seccion": 394
                },
                {
                    "distrito_local": 9,
                    "seccion": 395
                },
                {
                    "distrito_local": 9,
                    "seccion": 396
                },
                {
                    "distrito_local": 9,
                    "seccion": 399
                },
                {
                    "distrito_local": 9,
                    "seccion": 388
                },
                {
                    "distrito_local": 9,
                    "seccion": 377
                },
                {
                    "distrito_local": 9,
                    "seccion": 397
                },
                {
                    "distrito_local": 9,
                    "seccion": 380
                },
                {
                    "distrito_local": 9,
                    "seccion": 375
                },
                {
                    "distrito_local": 9,
                    "seccion": 379
                },
                {
                    "distrito_local": 9,
                    "seccion": 387
                },
                {
                    "distrito_local": 9,
                    "seccion": 378
                },
                {
                    "distrito_local": 9,
                    "seccion": 381
                },
                {
                    "distrito_local": 9,
                    "seccion": 382
                },
                {
                    "distrito_local": 9,
                    "seccion": 383
                },
                {
                    "distrito_local": 9,
                    "seccion": 384
                },
                {
                    "distrito_local": 9,
                    "seccion": 385
                },
                {
                    "distrito_local": 9,
                    "seccion": 386
                },
                {
                    "distrito_local": 11,
                    "seccion": 535
                },
                {
                    "distrito_local": 11,
                    "seccion": 529
                },
                {
                    "distrito_local": 11,
                    "seccion": 376
                },
                {
                    "distrito_local": 11,
                    "seccion": 536
                },
                {
                    "distrito_local": 11,
                    "seccion": 528
                },
                {
                    "distrito_local": 11,
                    "seccion": 373
                },
                {
                    "distrito_local": 11,
                    "seccion": 530
                },
                {
                    "distrito_local": 11,
                    "seccion": 531
                },
                {
                    "distrito_local": 11,
                    "seccion": 532
                },
                {
                    "distrito_local": 11,
                    "seccion": 534
                },
                {
                    "distrito_local": 11,
                    "seccion": 355
                },
                {
                    "distrito_local": 11,
                    "seccion": 372
                },
                {
                    "distrito_local": 11,
                    "seccion": 533
                },
                {
                    "distrito_local": 11,
                    "seccion": 317
                },
                {
                    "distrito_local": 11,
                    "seccion": 371
                },
                {
                    "distrito_local": 11,
                    "seccion": 316
                },
                {
                    "distrito_local": 11,
                    "seccion": 324
                },
                {
                    "distrito_local": 11,
                    "seccion": 325
                },
                {
                    "distrito_local": 11,
                    "seccion": 326
                },
                {
                    "distrito_local": 11,
                    "seccion": 334
                },
                {
                    "distrito_local": 11,
                    "seccion": 354
                },
                {
                    "distrito_local": 11,
                    "seccion": 367
                },
                {
                    "distrito_local": 11,
                    "seccion": 369
                },
                {
                    "distrito_local": 11,
                    "seccion": 370
                },
                {
                    "distrito_local": 11,
                    "seccion": 368
                },
                {
                    "distrito_local": 12,
                    "seccion": 520
                },
                {
                    "distrito_local": 12,
                    "seccion": 312
                },
                {
                    "distrito_local": 12,
                    "seccion": 521
                },
                {
                    "distrito_local": 12,
                    "seccion": 519
                },
                {
                    "distrito_local": 12,
                    "seccion": 518
                },
                {
                    "distrito_local": 12,
                    "seccion": 517
                },
                {
                    "distrito_local": 12,
                    "seccion": 516
                },
                {
                    "distrito_local": 12,
                    "seccion": 313
                },
                {
                    "distrito_local": 12,
                    "seccion": 310
                },
                {
                    "distrito_local": 12,
                    "seccion": 309
                },
                {
                    "distrito_local": 12,
                    "seccion": 308
                },
                {
                    "distrito_local": 12,
                    "seccion": 307
                },
                {
                    "distrito_local": 12,
                    "seccion": 306
                },
                {
                    "distrito_local": 12,
                    "seccion": 305
                },
                {
                    "distrito_local": 12,
                    "seccion": 304
                },
                {
                    "distrito_local": 12,
                    "seccion": 303
                },
                {
                    "distrito_local": 12,
                    "seccion": 522
                },
                {
                    "distrito_local": 12,
                    "seccion": 311
                },
                {
                    "distrito_local": 16,
                    "seccion": 525
                },
                {
                    "distrito_local": 16,
                    "seccion": 398
                },
                {
                    "distrito_local": 16,
                    "seccion": 400
                },
                {
                    "distrito_local": 16,
                    "seccion": 401
                },
                {
                    "distrito_local": 16,
                    "seccion": 402
                },
                {
                    "distrito_local": 16,
                    "seccion": 403
                },
                {
                    "distrito_local": 16,
                    "seccion": 404
                },
                {
                    "distrito_local": 16,
                    "seccion": 411
                },
                {
                    "distrito_local": 16,
                    "seccion": 352
                },
                {
                    "distrito_local": 16,
                    "seccion": 524
                },
                {
                    "distrito_local": 16,
                    "seccion": 328
                },
                {
                    "distrito_local": 16,
                    "seccion": 526
                },
                {
                    "distrito_local": 16,
                    "seccion": 523
                },
                {
                    "distrito_local": 16,
                    "seccion": 351
                },
                {
                    "distrito_local": 16,
                    "seccion": 336
                },
                {
                    "distrito_local": 16,
                    "seccion": 335
                },
                {
                    "distrito_local": 16,
                    "seccion": 333
                },
                {
                    "distrito_local": 16,
                    "seccion": 329
                },
                {
                    "distrito_local": 16,
                    "seccion": 327
                },
                {
                    "distrito_local": 16,
                    "seccion": 323
                },
                {
                    "distrito_local": 16,
                    "seccion": 322
                },
                {
                    "distrito_local": 16,
                    "seccion": 321
                },
                {
                    "distrito_local": 16,
                    "seccion": 320
                },
                {
                    "distrito_local": 16,
                    "seccion": 319
                },
                {
                    "distrito_local": 16,
                    "seccion": 318
                },
                {
                    "distrito_local": 16,
                    "seccion": 527
                },
                {
                    "distrito_local": 16,
                    "seccion": 331
                }
            
        ]'; // Ajusta este número según sea necesario

        $data = json_decode($json, true);

        if (is_array($data)) {
            foreach ($data as $item) {
                // Obtener el ID del distrito utilizando el modelo District
                $districtId = District::where('number', '=', $item['distrito_local'])
                    ->first()
                    ->id;

                // Insertar la sección con el district_id obtenido
                DB::table('sections')->insert([
                    'number' => $item['seccion'],
                    'district_id' => $districtId,
                ]);
            }
        } else {
            echo "Error decoding JSON";
        }
    }
}
